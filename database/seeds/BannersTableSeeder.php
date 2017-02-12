<?php

use App\Models\DataRow;
use App\Models\DataType;
use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$bannerDataType = DataType::where('slug', 'banners')->firstOrFail();
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $bannerDataType->id,
			'field' => 'id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'PRI',
				'display_name' => 'ID',
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
			'data_type_id' => $bannerDataType->id,
			'field' => 'name',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '名称',
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
			'data_type_id' => $bannerDataType->id,
			'field' => 'title',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '标题',
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
			'data_type_id' => $bannerDataType->id,
			'field' => 'user_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '创建者',
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

		$banner = Banner::firstOrNew([
			'name' => 'testbanner',
		]);
		if (! $banner->exists) {
			$banner->fill([
				'title' => '牛逼了我的哥',
                'user_id' => 1,
			])->save();
		}

	}
}
