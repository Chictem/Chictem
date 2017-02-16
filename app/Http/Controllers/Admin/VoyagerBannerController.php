<?php

namespace App\Http\Controllers\Admin;

use App\Models\DataType;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\BannerItem;
use App\Facades\Voyager;

class VoyagerBannerController extends Controller
{
	/**
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function builder($id)
	{
		Voyager::can('edit_banners');

		$banner = Banner::findOrFail($id);

		return view('voyager::banners.builder', compact('banner'));
	}

	/**
	 * @param $banner
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete_banner($banner, $id)
	{
		Voyager::can('delete_banners');

		$item = BannerItem::findOrFail($id);

		$item->destroy($id);

		return redirect()->route('voyager.banners.builder', [$banner])->with([
			'message' => trans('flash.delete', ['name' => trans('common.model.banner_item')]),
			'alert-type' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function add_item(Request $request)
	{
		$slug = 'banner_items';

		$dataType = DataType::where('slug', '=', $slug)->first();
		// Check permission
		Voyager::can('add_' . $dataType->name);

		$data = new $dataType->model_name();

		$result = $this->insertUpdateData($request, $slug, $dataType->addRows, $data);

		return redirect()->route('voyager.banners.builder', [$result->banner_id])->with([
			'message' => trans('flash.add', ['name' => trans('common.model.banner_item')]),
			'alert-type' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update_item(Request $request)
	{

		$id = $request->get('id');
		//dd($request);
		$slug = 'banner_items';

		$dataType = DataType::where('slug', '=', $slug)->first();

		// Check permission
		Voyager::can('edit_' . $dataType->name);

		$data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
		$bannerItem = $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

		return redirect()->route('voyager.banners.builder', [$bannerItem->banner_id])->with([
			'message' => trans('flash.edit', ['name' => trans('common.model.banner_item')]),
			'alert-type' => 'success',
		]);
	}

	/**
	 * @param Request $request
	 */
	public function order_item(Request $request)
	{
		$bannerItemOrder = json_decode($request->input('order'));

		$this->orderBanner($bannerItemOrder, null);
	}

	/**
	 * @param array $bannerItems
	 * @param       $parentId
	 */
	private function orderBanner(array $bannerItems, $parentId)
	{
		foreach ($bannerItems as $index => $bannerItem) {
			$item = BannerItem::findOrFail($bannerItem->id);
			$item->order = $index + 1;
			$item->parent_id = $parentId;
			$item->save();

			if (isset($bannerItem->children)) {
				$this->orderBanner($bannerItem->children, $item->id);
			}
		}
	}
}
