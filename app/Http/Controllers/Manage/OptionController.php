<?php

namespace App\Http\Controllers\Manage;

use App\Http\Requests\ArrayRequest;
use App\Http\Requests\OptionRequest;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use UxWeb\SweetAlert\SweetAlert;

class OptionController extends Controller
{
    /**
     * View space.
     *
     * @var string
     */
    protected $space = 'option';

    /**
     * Option items.
     *
     * @var array
     */
    private $option_items = [
        'title',
        'subtitle',
        'description',
    ];

    /**
     * Index to option.
     *
     * @return mixed
     */
    public function getIndex()
    {
        return $this->getEditUrl();
    }

    /**
     * Get option page.
     *
     * @return mixed
     */
    public function getEdit()
    {
        return view($this->getManageView('edit'))->with([
            'options' => Option::all(),
            'option_items' => $this->option_items,
        ]);
    }

    /**
     * Update options.
     *
     * @param ConfigRequest $request
     * @return mixed
     */
    public function postUpdate(Request $request)
    {
        $options = $request->all();
        foreach ($options as $key => $value) {
            Option::item($key)->update(['value' => $value]);
        }
	    SweetAlert::success('提示信息', '修改成功');
        Flash::success('修改成功!');
        return $this->getEditUrl();
    }

    /**
     * Configure items.
     *
     * @return mixed
     */
    public function getItems()
    {
        return view($this->getManageView('items'))->with([
            'items' => Option::where('type', '<>', 'array')->get(),
        ]);
    }

    /**
     * Update option items..
     *
     * @param ArrayRequest $request
     * @return $this
     */
    public function postItems(OptionRequest $request)
    {
        $id = $request->get('id');
        $this->uniqueKey($request, $id);
        Option::updateOrCreate(['id' => $id], $request->all());
        Flash::success('保存成功!');
        return redirect()->back();
    }

    /**
     * Edit array values.
     *
     * @return $this
     */
    public function getArray()
    {
        return view($this->getManageView('array'))->with([
            'arrays' => Option::type('array')
        ]);
    }

    /**
     * Update array values.
     *
     * @param ArrayRequest $request
     * @return $this
     */
    public function postArray(ArrayRequest $request)
    {
        $id = $request->get('id');
        $this->uniqueKey($request, $id);
        $info = $request->only('key', 'display_name', 'type');
        $array = $request->get('value');
        $array = assoc_to_index($array);
        foreach ($array as $item) {
            $result[$item['key']] = $item['value'];
        }
        Option::updateOrCreate(['id' => $id], array_merge($info, ['value' => $result]));
        Flash::success('保存成功!');
        return $this->getArrayUrl();
    }

    /**
     * Delete array.
     *
     * @param $id
     * @return mixed
     */
    public function getDeleteItem($id)
    {
        $option = Option::find($id);
        if (!$option->deletable) {
            Flash::error('该配置项不能删除!');
            return Redirect::back();
        }
        if ($option->delete()) {
            Flash::success('删除成功!');
        } else {
            Flash::error('删除失败!');
        }
        return Redirect::back();
    }

    /**
     * Get url manage url.
     *
     * @return mixed
     */
    private function getArrayUrl()
    {
        return Redirect::to('/manage/option/array');
    }

    /**
     * Get manage url.
     *
     * @return mixed
     */
    private function getEditUrl()
    {
        return Redirect::to('/manage/option/edit');
    }

    /**
     * Get items url.
     *
     * @return mixed
     */
    private function getItemsUrl()
    {
        return Redirect::to('/manage/option/items');
    }


    /**
     * Confirm it is unique.
     *
     * @param Request $request
     * @param $id
     */
    private function uniqueKey(Request $request, $id)
    {
        if (! Option::find($id) || Option::find($id)->key != $request->get('key')) {
            $this->validate($request, [
                'key' => 'unique:options',
            ], [], [
                'key' => '数组键名',
            ]);
        }
    }


}
