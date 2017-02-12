<?php

use Illuminate\Database\Seeder;

class BannerItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $bannerItemDataType = DataType::where('slug', 'banner_items')->firstOrFail();
	    $dataRow = DataRow::firstOrNew([
		    'data_type_id' => $bannerItemDataType->id,
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
		    'data_type_id' => $bannerItemDataType->id,
		    'field' => 'title',
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
		    'data_type_id' => $bannerItemDataType->id,
		    'field' => 'description',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'text_area',
			    'display_name' => '描述',
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
		    'data_type_id' => $bannerItemDataType->id,
		    'field' => 'banner_id',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'select_dropdown',
			    'display_name' => '图文组',
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
		    'data_type_id' => $bannerItemDataType->id,
		    'field' => 'parent_id',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'select_dropdown',
			    'display_name' => '父图文项',
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
		    'data_type_id' => $bannerItemDataType->id,
		    'field' => 'url',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'text',
			    'display_name' => 'URL',
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
		    'data_type_id' => $bannerItemDataType->id,
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
		    'data_type_id' => $bannerItemDataType->id,
		    'field' => 'image_url',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'text',
			    'display_name' => '图片链接',
			    'required' => 1,
			    'browse' => 1,
			    'read' => 1,
			    'edit' => 1,
			    'add' => 1,
			    'delete' => 1,
			    'details' => '',
		    ])->save();
	    }
	    
    }
}
