<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataType;
use Illuminate\Support\Facades\Schema;

class VoyagerBreadController extends Controller
{

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(Request $request)
	{
		// GET THE SLUG, ex. 'posts', 'pages', etc.
		$slug = $this->getSlug($request);

		// GET THE DataType based on the slug
		$dataType = DataType::where('slug', '=', $slug)->first();

		// Check permission
		Voyager::can('browse_' . $dataType->name);

		$getter = $dataType->server_side ? 'paginate' : 'get';

		// Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
		if (strlen($dataType->model_name) != 0) {
			$model = app($dataType->model_name);
			if ($orderBy = $request->query('order_by')) {
				$query = $model->orderBy($orderBy, $request->query('order_mode', 'desc'));
			} else if ($model->timestamps) {
				$query = $model->latest();
			} else {
				$query = $model->orderBy('id', 'DESC');
			}
		} else {
			$query = DB::table($dataType->name);
		}

		$queries = $request->query();
		foreach ($queries as $key => $value) {
			if (Schema::hasColumn($slug, $key)) {
				$query = $query->where($key, $value);
			}
		}

		if (searchable($dataType->model_name)) {
			$query = $query->search($request->get('search', ''));
		}

		$dataTypeContent = call_user_func([$query, $getter]);


		$view = 'voyager::bread.browse';

		if (view()->exists("voyager::$slug.browse")) {
			$view = "voyager::$slug.browse";
		}

		return view($view, compact('dataType', 'dataTypeContent'));
	}

	/**
	 * @param Request $request
	 * @param         $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show(Request $request, $id)
	{
		$slug = $this->getSlug($request);

		$dataType = DataType::where('slug', '=', $slug)->first();

		// Check permission
		Voyager::can('read_' . $dataType->name);

		$dataTypeContent = (strlen($dataType->model_name) != 0) ? call_user_func([
			$dataType->model_name,
			'findOrFail'
		], $id) : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

		$view = 'voyager::bread.read';

		if (view()->exists("voyager::$slug.read")) {
			$view = "voyager::$slug.read";
		}

		return view($view, compact('dataType', 'dataTypeContent'));
	}

	/**
	 * @param Request $request
	 * @param         $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Request $request, $id)
	{
		$slug = $this->getSlug($request);

		$dataType = DataType::where('slug', '=', $slug)->first();

		// Check permission
		Voyager::can('edit_' . $dataType->name);

		$dataTypeContent = (strlen($dataType->model_name) != 0) ? call_user_func([
			$dataType->model_name,
			'findOrFail'
		], $id) : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

		$view = 'voyager::bread.edit-add';

		if (view()->exists("voyager::$slug.edit-add")) {
			$view = "voyager::$slug.edit-add";
		}

		return view($view, compact('dataType', 'dataTypeContent'));
	}

	/**
	 * @param Request $request
	 * @param         $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, $id)
	{
		$slug = $this->getSlug($request);

		$dataType = DataType::where('slug', '=', $slug)->first();

		// Check permission
		Voyager::can('edit_' . $dataType->name);

		$data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
		$this->insertUpdateData($request, $slug, $dataType->editRows, $data);

		return redirect()->back()->with([
			'message' => trans('flash.edit', ['name' => $dataType->display_name_singular]),
			'alert-type' => 'success',
		]);
	}


	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create(Request $request)
	{
		$slug = $this->getSlug($request);

		$dataType = DataType::where('slug', '=', $slug)->first();

		// Check permission
		Voyager::can('add_' . $dataType->name);

		$view = 'voyager::bread.edit-add';

		if (view()->exists("voyager::$slug.edit-add")) {
			$view = "voyager::$slug.edit-add";
		}

		return view($view, compact('dataType'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		$slug = $this->getSlug($request);

		$dataType = DataType::where('slug', '=', $slug)->first();

		// Check permission
		Voyager::can('add_' . $dataType->name);

		if (function_exists('voyager_add_post')) {
			$url = $request->url();
			voyager_add_post($request);
		}

		$data = new $dataType->model_name();
		$this->insertUpdateData($request, $slug, $dataType->addRows, $data);

		return redirect()->route("voyager.{$dataType->slug}.index")->with([
			'message' => trans('flash.add', ['name' => $dataType->display_name_singular]),
			'alert-type' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 * @param         $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Request $request, $id)
	{
		$slug = $this->getSlug($request);

		$dataType = DataType::where('slug', '=', $slug)->first();

		// Check permission
		Voyager::can('delete_' . $dataType->name);

		$data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

		foreach ($dataType->deleteRows as $row) {
			if ($row->type == 'image') {
				$this->deleteFileIfExists('/uploads/' . $data->{$row->field});

				$options = json_decode($row->details);

				if (isset($options->thumbnails)) {
					foreach ($options->thumbnails as $thumbnail) {
						$ext = explode('.', $data->{$row->field});
						$extension = '.' . $ext[count($ext) - 1];

						$path = str_replace($extension, '', $data->{$row->field});

						$thumb_name = $thumbnail->name;

						$this->deleteFileIfExists('/uploads/' . $path . '-' . $thumb_name . $extension);
					}
				}
			}
		}

		$data = $data->destroy($id) ? [
			'message' => trans('flash.delete', ['name' => $dataType->display_name_singular]),
			'alert-type' => 'success',
		] : [
			'message' => trans('flash.error'),
			'alert-type' => 'error',
		];

		return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
	}
}
