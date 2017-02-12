<?php

namespace App\Http\Controllers;

use App\Facades\Voyager;
use App\Models\DataType;
use Germey\Generator\Utils\ResponseUtil;
use Illuminate\Http\Request;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
	/**
	 * @param $result
	 * @param $message
	 * @return mixed
	 */
	public function sendResponse($result, $message)
	{
		return Response::json(ResponseUtil::makeResponse($message, $result));
	}

	/**
	 * @param     $error
	 * @param int $code
	 * @return mixed
	 */
	public function sendError($error, $code = 404)
	{
		return Response::json(ResponseUtil::makeError($error), $code);
	}


	/**
	 * @param Request $request
	 */
	public function index(Request $request)
	{
		$slug = $this->getSlug($request);

		// GET THE DataType based on the slug
		$dataType = DataType::where('slug', '=', $slug)->first();

		// Check permission
		Voyager::can('browse_' . $dataType->name);

		$getter = 'paginate';

		// Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
		if (strlen($dataType->model_name) != 0) {
			$model = app($dataType->model_name);

			$dataTypeContent = call_user_func([$model->orderBy('id', 'DESC'), $getter]);
		} else {
			// If Model doesn't exist, get data from table name
			$dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
		}

		//dd($dataType, $dataTypeContent);

		$view = "models.index";

		if (view()->exists($slug . '.index')) {
			$view = $slug . '.index';
		}

		return view($view, ['dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, $slug => $dataTypeContent]);

	}


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

		$view = 'models.show';

		if (view()->exists($slug . '.show')) {
			$view = $slug . '.show';
		}

		//		dd($dataTypeContent, $dataType);
		return view($view, [
			'dataType' => $dataType,
			'dataTypeContent' => $dataTypeContent,
			str_singular($slug) => $dataTypeContent
		]);

	}
}
