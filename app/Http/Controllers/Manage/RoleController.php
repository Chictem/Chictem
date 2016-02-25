<?php

namespace App\Http\Controllers\Manage;

use App\Model\Menu;
use Illuminate\Http\Request;
use App\Model\Role;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class RoleController extends Controller
{
    /**
     * View space.
     *
     * @var string
     */
    protected $space = 'role';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view($this->getManageView('index'))->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Role $role)
    {
        return view($this->getManageView('show'))->withRole($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Update permissions of role.
     *
     * @param Request $request
     */
    public function postUpdatePerms(Request $request, $id)
    {
        $role = Role::find($id);
        if($role->perms()->sync($request->get('permissions'))) {
            Flash::success('修改成功!');
        } else {
            Flash::error('修改失败!');
        }
        return Redirect::to('/manage/role/'.$id);
    }

}
