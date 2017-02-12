<?php

use App\Models\DataRow;
use App\Models\DataType;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$companyDataType = DataType::where('slug', 'companies')->firstOrFail();
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $companyDataType->id,
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
			'data_type_id' => $companyDataType->id,
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
			'data_type_id' => $companyDataType->id,
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
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $companyDataType->id,
			'field' => 'website',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '官网',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $companyDataType->id,
			'field' => 'location',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '地址',
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
			'data_type_id' => $companyDataType->id,
			'field' => 'phone',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '电话',
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
			'data_type_id' => $companyDataType->id,
			'field' => 'image',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => '图像',
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
			'data_type_id' => $companyDataType->id,
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
				}'
			])->save();
		}


		$company = Company::firstOrNew([
			'name' => '钉趣网络科技',
		]);
		if (! $company->exists) {
			$company->fill([
				'image' => '/storage/users/default.png',
				'description' => '钉趣网络科技有限公司',
			    'location' => '北京',
			    'website' => 'www.dqu.com',
				'phone' => '010-32355435'

			])->save();
		}

		$company = Company::firstOrNew([
			'name' => '百度科技',
		]);
		if (! $company->exists) {
			$company->fill([
				'image' => '/storage/users/default.png',
				'description' => '百度网络科技有限公司',
				'location' => '北京',
				'website' => 'www.baidu.com',
				'phone' => '010-32355435'
			])->save();
		}
	}
}
