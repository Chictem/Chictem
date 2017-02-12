<?php

use App\Models\DataRow;
use App\Models\DataType;
use App\Models\Expert;
use Illuminate\Database\Seeder;

class ExpertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $expertDataType = DataType::where('slug', 'experts')->firstOrFail();
	    $dataRow = DataRow::firstOrNew([
		    'data_type_id' => $expertDataType->id,
		    'field' => 'id',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'PRI',
			    'display_name' => 'ID',
			    'required' => 1,
			    'browse' => 0,
			    'read' => 1,
			    'edit' => 1,
			    'add' => 0,
			    'delete' => 1,
			    'details' => '',
		    ])->save();
	    }

	    $dataRow = DataRow::firstOrNew([
		    'data_type_id' => $expertDataType->id,
		    'field' => 'name',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'text',
			    'display_name' => '讲师姓名',
			    'required' => 1,
			    'browse' => 1,
			    'read' => 1,
			    'edit' => 1,
			    'add' => 1,
			    'delete' => 1,
			    'details' => '',
		    ])->save();
	    }

	    $dataRow = DataRow::firstOrNew([
		    'data_type_id' => $expertDataType->id,
		    'field' => 'image',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'image',
			    'display_name' => '讲师照片',
			    'required' => 0,
			    'browse' => 1,
			    'read' => 1,
			    'edit' => 1,
			    'add' => 1,
			    'delete' => 1,
			    'details' => '{
					"resize": {
						"width": "1000",
						"height": "null"
					},
					"quality": "70%",
					"upsize": true,
					"thumbnails": [
						{
							"name": "medium",
							"scale": "50%"
						},
						{
							"name": "small",
							"scale": "25%"
						},
						{
							"name": "cropped",
							"crop": {
								"width": "300",
								"height": "250"
							}
						}
					]
				}',
		    ])->save();
	    }

	    $dataRow = DataRow::firstOrNew([
		    'data_type_id' => $expertDataType->id,
		    'field' => 'description',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'text_area',
			    'display_name' => '介绍',
			    'required' => 0,
			    'browse' => 1,
			    'read' => 1,
			    'edit' => 1,
			    'add' => 1,
			    'delete' => 1,
		    ])->save();
	    }

	    $dataRow = DataRow::firstOrNew([
		    'data_type_id' => $expertDataType->id,
		    'field' => 'age',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'text',
			    'display_name' => '年龄',
			    'required' => 0,
			    'browse' => 1,
			    'read' => 1,
			    'edit' => 1,
			    'add' => 1,
			    'delete' => 1,
			    'details' => '',
		    ])->save();
	    }

	    $expert = Expert::firstOrNew([
		    'name' => '吴恩达',
	    ]);
	    if (! $expert->exists) {
		    $expert->fill([
			    'image' => '/storage/users/default.png',
			    'description' => '德上智慧首席讲师, 曾主讲多次安全教育课程',
			    'age' => 32,
		    ])->save();
	    }

	    $expert = Expert::firstOrNew([
		    'name' => '特级专家',
	    ]);
	    if (! $expert->exists) {
		    $expert->fill([
			    'image' => '/storage/users/default.png',
			    'description' => '前启明高级安全员, 曾主讲多次安全教育课程',
			    'age' => 39,
		    ])->save();
	    }

	    $expert = Expert::firstOrNew([
		    'name' => '特级专家2',
	    ]);
	    if (! $expert->exists) {
		    $expert->fill([
			    'image' => '/storage/users/default.png',
			    'description' => '前启明高级安全员3, 曾主讲多次安全教育课程',
			    'age' => 13,
		    ])->save();
	    }

	    $expert = Expert::firstOrNew([
		    'name' => '特级专家3',
	    ]);
	    if (! $expert->exists) {
		    $expert->fill([
			    'image' => '/storage/users/default.png',
			    'description' => '前启明高级安全员2, 曾主讲多次安全教育课程',
			    'age' => 33,
		    ])->save();
	    }
    }
}
