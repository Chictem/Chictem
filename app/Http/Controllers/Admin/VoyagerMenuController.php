<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Facades\Voyager;

class VoyagerMenuController extends Controller
{
    public function builder($id)
    {
        Voyager::can('edit_menus');

        $menu = Menu::findOrFail($id);

        return view('voyager::menus.builder', compact('menu'));
    }

    public function delete_menu($menu, $id)
    {
        Voyager::can('delete_menus');

        $item = MenuItem::findOrFail($id);

        $item->destroy($id);

        return redirect()
            ->route('voyager.menus.builder', [$menu])
            ->with([
                'message'    => 'Successfully Deleted Menu Item.',
                'alert-type' => 'success',
            ]);
    }

    public function add_item(Request $request)
    {
        Voyager::can('add_menus');

        $data = $request->all();
        $data['order'] = 1;

        $highestOrderMenuItem = MenuItem::where('parent_id', '=', null)
            ->orderBy('order', 'DESC')
            ->first();

        if (!is_null($highestOrderMenuItem)) {
            $data['order'] = intval($highestOrderMenuItem->order) + 1;
        }

        MenuItem::create($data);

        return redirect()
            ->route('voyager.menus.builder', [$data['menu_id']])
            ->with([
                'message'    => 'Successfully Created New Menu Item.',
                'alert-type' => 'success',
            ]);
    }

    public function update_item(Request $request)
    {
        Voyager::can('edit_menus');

        $id = $request->input('id');
        $data = $request->except(['id']);

        $menuItem = MenuItem::findOrFail($id);
        $menuItem->update($data);

        return redirect()
            ->route('voyager.menus.builder', [$menuItem->menu_id])
            ->with([
                'message'    => 'Successfully Updated Menu Item.',
                'alert-type' => 'success',
            ]);
    }

    public function order_item(Request $request)
    {
        $menuItemOrder = json_decode($request->input('order'));

        $this->orderMenu($menuItemOrder, null);
    }

    private function orderMenu(array $menuItems, $parentId)
    {
        foreach ($menuItems as $index => $menuItem) {
            $item = MenuItem::findOrFail($menuItem->id);
            $item->order = $index + 1;
            $item->parent_id = $parentId;
            $item->save();

            if (isset($menuItem->children)) {
                $this->orderMenu($menuItem->children, $item->id);
            }
        }
    }
}
