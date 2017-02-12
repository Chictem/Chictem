<?php

use App\Models\Course;
use App\Models\DataRow;
use App\Models\DataType;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$courseDataType = DataType::where('slug', 'courses')->firstOrFail();
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $courseDataType->id,
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
			'data_type_id' => $courseDataType->id,
			'field' => 'name',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '课程名称',
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
			'data_type_id' => $courseDataType->id,
			'field' => 'description',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text_area',
				'display_name' => '课程描述',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $courseDataType->id,
			'field' => 'image',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => '预览图',
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
			'data_type_id' => $courseDataType->id,
			'field' => 'banner',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => '头图',
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
			'data_type_id' => $courseDataType->id,
			'field' => 'url',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '视频链接',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $courseDataType->id,
			'field' => 'duration',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '视频时长',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $courseDataType->id,
			'field' => 'category_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '类别',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '{
					"relationship": {
						"key": "id",
						"label": "name"
					}
				}'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $courseDataType->id,
			'field' => 'teacher_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '讲师',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '{
					"relationship": {
						"key": "id",
						"label": "name"
					}
				}'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $courseDataType->id,
			'field' => 'company_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '公司',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '{
					"relationship": {
						"key": "id",
						"label": "name"
					}
				}'
			])->save();
		}

		for ($i = 0; $i < 5; $i ++) {
			$course = Course::firstOrNew([
				'name' => '路上交通安全教育' . $i,
			]);
			if (! $course->exists) {
				$course->fill([
					'image' => '/storage/users/default.png',
					'url' => 'http://s1.ananas.chaoxing.com/video/d4/55ffc449712e0c839614724e/sd.mp4',
					'duration' => '3分11秒',
					'description' => '路上交通安全教育视频, 主动避让车辆',
					'weight' => 1,
				    'banner' => ''
				])->save();
			}
			$course = Course::firstOrNew([
				'name' => '地震安全教育' . $i,
			]);
			if (! $course->exists) {
				$course->fill([
					'image' => '/storage/users/default.png',
					'url' => 'http://resource.deshang365.com/ugc/mp4/aq/212.flv',
					'duration' => '6分55秒',
					'description' => '地震来了要镇静, 不慌张',
					'weight' => 2,
				    'banner' => ''
				])->save();
			}
		}


	}
}
