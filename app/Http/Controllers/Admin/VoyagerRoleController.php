<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Voyager;
use Illuminate\Http\Request;
use App\Models\DataType;

class VoyagerRoleController extends VoyagerBreadController
{
	/**
	 * @param Request $request
	 * @param         $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Request $request, $id)
    {
        Voyager::can('edit_roles');

        $slug = $this->getSlug($request);

        $dataType = DataType::where('slug', '=', $slug)->first();

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        $data->permissions()->sync($request->input('permissions', []));

        return redirect()
            ->back()
            ->with([
                'message'    => trans('flash.edit', ['name' => $dataType->display_name_singular]),
                'alert-type' => 'success',
            ]);
    }

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
    {
        Voyager::can('add_roles');

        $slug = $this->getSlug($request);

        $dataType = DataType::where('slug', '=', $slug)->first();

        if (function_exists('voyager_add_post')) {
            voyager_add_post($request);
        }

        $data = new $dataType->model_name();
        $this->insertUpdateData($request, $slug, $dataType->addRows, $data);

        $data->permissions()->sync($request->input('permissions', []));

        return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => trans('flash.add', ['name' => $dataType->display_name_singular]),
                'alert-type' => 'success',
            ]);
    }
}
