<?php

namespace App\Http\Controllers\Manage;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use Zizaco\Entrust\Entrust;

class MenuController extends Controller
{

    /**
     * Controller construct method.
     */
    public function __construct()
    {
        $this->middleware('permission:add-menu', ['only' => ['create', 'store']]);
    }

    /**
     * View space.
     *
     * @var string
     */
    protected $space = 'menu';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view($this->getManageView('index'))->withMenus($menus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->getManageView('create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        if ($menu = Auth::user()->menus()->create($request->all())) {
            return Redirect::to('/manage/menu/' . $menu->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view($this->getManageView('show'))->withMenu($menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        if ($menu->update($request->all())) {
            Flash::success('保存成功!');
        } else {
            Flash::error('保存失败!');
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu->delete()) {
            Flash::success('删除成功!');
        } else {
            Flash::error('删除失败!');
        }
        return Redirect::back();
    }
}
