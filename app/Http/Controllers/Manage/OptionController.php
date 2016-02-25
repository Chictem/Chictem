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
        return Redirect::to('manage/option/edit');
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
        Flash::success('修改成功！');
        return Redirect::to('/manage/option/edit');
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
        $this->validate($request, [
            'key' => 'required|unique:options',
            'value' => 'required',
        ]);
        dd($request->all());
        $info = $request->only('key', 'display_name');
        $array = $request->get('value');
        $array = assoc_to_index($array);
        foreach ($array as $item) {
            $result[$item['key']] = $item['value'];
        }
        Option::updateOrCreate(['id' => $request->get('id')], array_merge($info, ['value' => $result]));
        Flash::success('修改成功！');
        return Redirect::to('/manage/option/array');
    }

}
