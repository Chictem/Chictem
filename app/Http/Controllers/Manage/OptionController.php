<?php

namespace App\Http\Controllers\Manage;

use App\Http\Requests\ArrayRequest;
use App\Model\Option;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

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
        'description'
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
        Flash::success('修改成功!');
        return $this->getEditUrl();
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
        $info = $request->only('key', 'display_name', 'type');
        $array = $request->get('value');
        $array = assoc_to_index($array);
        foreach ($array as $item) {
            $result[$item['key']] = $item['value'];
        }
        Option::updateOrCreate(['id' => $request->get('id')], array_merge($info, ['value' => $result]));
        Flash::success('保存成功!');
        return $this->getArrayUrl();
    }

    /**
     * Delete array.
     *
     * @param $id
     * @return mixed
     */
    public function getDeleteArray($id) {
        $option = Option::find($id);
        if ($option->delete()){
            Flash::success('删除成功!');
        } else {
            Flash::error('删除失败!');
        }
        return $this->getArrayUrl();
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


}
