<?php

use Illuminate\Database\Seeder;
use App\Models\DataRow;
use App\Models\DataType;

class DataRowsTableSeeder extends Seeder
{
	/**
	 * Auto generated seed file.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->seedPostsDataRow();
		$this->seedPagesDataRow();
		$this->seedUsersDataRow();
		$this->seedCategoriesDataRow();
		$this->seedMenusDataRow();
		$this->seedMenuItemsDataRow();
		$this->seedRolesDataRow();
		$this->seedDataRowsDataRow();
		$this->seedBannersDataRow();
		$this->seedSettingsDataRow();
	}


	public function seedPostsDataRow()
	{
		$postDataType = DataType::where('slug', 'posts')->firstOrFail();

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
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
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'user_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '发布者',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '{
					"relationship": {
						"key": "id",
						"label": "name"
					}
				}'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'category_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '分类',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '{
					"relationship": {
						"key": "id",
						"label": "name"
					}
				}'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'title',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '标题',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'seo_title',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'SEO标题',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'excerpt',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text_area',
				'display_name' => '摘要',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'body',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'rich_text_box',
				'display_name' => '正文',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'image',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => '特色图像',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
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
			'data_type_id' => $postDataType->id,
			'field' => 'banner',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => '头图',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
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
			'data_type_id' => $postDataType->id,
			'field' => 'slug',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '别名',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'meta_description',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text_area',
				'display_name' => 'SEO描述',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'meta_keywords',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text_area',
				'display_name' => 'SEO关键字',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'status',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '状态',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '{
					"default": "DRAFT",
					"options": {
						"PUBLISHED": "published",
						"DRAFT": "draft",
						"PENDING": "pending"
					}
				}',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'featured',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'checkbox',
				'display_name' => '特色',
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
			'data_type_id' => $postDataType->id,
			'field' => 'created_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '创建时间',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 0,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $postDataType->id,
			'field' => 'updated_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '更新时间',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 0,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

	}

	public function seedPagesDataRow()
	{
		$pageDataType = DataType::where('slug', 'pages')->firstOrFail();

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $pageDataType->id,
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
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $pageDataType->id,
			'field' => 'user_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '发布者',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '{
					"relationship": {
						"key": "id",
						"label": "name"
					}
				}'
			])->save();
		}

		$dataRow = DataRow::firstorNew([
			'data_type_id' => $pageDataType->id,
			'field' => 'title',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '标题',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $pageDataType->id,
			'field' => 'excerpt',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text_area',
				'display_name' => '摘要',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $pageDataType->id,
			'field' => 'body',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'rich_text_box',
				'display_name' => '正文',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $pageDataType->id,
			'field' => 'image',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => '特色图像',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
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
			'data_type_id' => $pageDataType->id,
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
				'show' => 1,
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
			'data_type_id' => $pageDataType->id,
			'field' => 'slug',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '别名',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $pageDataType->id,
			'field' => 'meta_description',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'SEO描述',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $pageDataType->id,
			'field' => 'meta_keywords',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => 'SEO关键字',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $pageDataType->id,
			'field' => 'status',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '状态',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '{
					"default": "INACTIVE",
					"options": {
						"INACTIVE": "INACTIVE",
						"ACTIVE": "ACTIVE"
					}
				}',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $pageDataType->id,
			'field' => 'created_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '创建时间',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 0,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $pageDataType->id,
			'field' => 'updated_at',
		]);

		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '更新时间',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}
	}

	public function seedUsersDataRow()
	{
		$userDataType = DataType::where('slug', 'users')->firstOrFail();
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $userDataType->id,
			'field' => 'id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'PRI',
				'display_name' => 'ID',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $userDataType->id,
			'field' => 'name',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '用户名',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $userDataType->id,
			'field' => 'email',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '邮箱',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $userDataType->id,
			'field' => 'phone',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '手机',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $userDataType->id,
			'field' => 'password',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'password',
				'display_name' => '密码',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 1,
				'add' => 1,
				'delete' => 0,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $userDataType->id,
			'field' => 'remember_token',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '秘钥',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $userDataType->id,
			'field' => 'image',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => '头像',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
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
			'data_type_id' => $userDataType->id,
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
				'show' => 1,
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
			'data_type_id' => $userDataType->id,
			'field' => 'created_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '创建时间',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 0,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $userDataType->id,
			'field' => 'updated_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '更新时间',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $userDataType->id,
			'field' => 'role_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '角色',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 1,
				'add' => 1,
				'delete' => 0,
				'show' => 0,
				'details' => '{
					"relationship": {
						"key": "id",
						"label": "display_name"
					}
				}'
			])->save();
		}
	}

	public function seedCategoriesDataRow()
	{
		$categoryDataType = DataType::where('slug', 'categories')->firstOrFail();

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $categoryDataType->id,
			'field' => 'id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'PRI',
				'display_name' => 'ID',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $categoryDataType->id,
			'field' => 'parent_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '父ID',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $categoryDataType->id,
			'field' => 'order',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '顺序',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $categoryDataType->id,
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
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $categoryDataType->id,
			'field' => 'slug',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '别名',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $categoryDataType->id,
			'field' => 'image',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => '缩略图',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
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
			'data_type_id' => $categoryDataType->id,
			'field' => 'banner',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'image',
				'display_name' => '头图',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
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
			'data_type_id' => $categoryDataType->id,
			'field' => 'created_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '创建时间',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $categoryDataType->id,
			'field' => 'updated_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '更新时间',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 0,
				'details' => '',
			])->save();
		}
	}

	public function seedMenusDataRow()
	{
		$menuDataType = DataType::where('slug', 'menus')->firstOrFail();
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuDataType->id,
			'field' => 'id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'PRI',
				'display_name' => 'ID',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuDataType->id,
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
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuDataType->id,
			'field' => 'created_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '创建时间',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 0,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuDataType->id,
			'field' => 'updated_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '更新时间',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 0,
				'details' => '',
			])->save();
		}
	}
	
	public function seedMenuItemsDataRow() {
		$menuItemDataType = DataType::where('slug', 'menu_items')->firstOrFail();
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuItemDataType->id,
			'field' => 'id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'PRI',
				'display_name' => 'ID',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuItemDataType->id,
			'field' => 'menu_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '所属菜单',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuItemDataType->id,
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
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuItemDataType->id,
			'field' => 'url',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '链接',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuItemDataType->id,
			'field' => 'target',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '打开方式',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuItemDataType->id,
			'field' => 'icon_class',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '图标',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuItemDataType->id,
			'field' => 'color',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '颜色',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuItemDataType->id,
			'field' => 'parent_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '父ID',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuItemDataType->id,
			'field' => 'order',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '顺序',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuItemDataType->id,
			'field' => 'created_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '创建时间',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $menuItemDataType->id,
			'field' => 'updated_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '更新时间',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 0,
				'details' => '',
			])->save();
		}
	}

	public function seedRolesDataRow()
	{

		$roleDataType = DataType::where('slug', 'roles')->firstOrFail();

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $roleDataType->id,
			'field' => 'id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'PRI',
				'display_name' => 'ID',
				'required' => 1,
				'browse' => 0,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $roleDataType->id,
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
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $roleDataType->id,
			'field' => 'created_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '创建时间',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $roleDataType->id,
			'field' => 'updated_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '更新时间',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 0,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $roleDataType->id,
			'field' => 'display_name',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '展示名称',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

	}

	public function seedDataRowsDataRow()
	{
		$dataRowDataType = DataType::where('slug', 'data_rows')->firstOrFail();

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
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
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'data_type_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '模型类型',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '{
					"relationship": {
						"key": "id",
						"label": "name"
					}
				}'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'field',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '字段',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => ''
			])->save();
		}


		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'type',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'select_dropdown',
				'display_name' => '字段类型',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '{
				    "default" : "text",
				    "options" : {
				        "text": "短文本",
				        "text_area": "长文本",
				        "rich_text_box": "富文本",
				        "password": "密码",
				        "PRI": "自增主键",
				        "image": "图片",
				        "file": "文件",
				        "checkbox": "复选框",
				        "radio_btn": "单选框",
				        "select_dropdown": "下拉列表",
				        "select_multiple": "多选下拉列表",
				        "timestamp": "时间"
				    }
				}'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'display_name',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '展示名称',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => ''
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'required',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'radio_btn',
				'display_name' => '是否必填',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '{ 
					"options" : {
						"1": "是",
						"0": "否"
					},
					"default": "0",
				    "checked" : "true"
	            }'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'browse',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'radio_btn',
				'display_name' => '是否可预览',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '{ 
					"options" : {
						"1": "是",
						"0": "否"
					},
					"default": "0",
				    "checked" : "true"
	            }'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'read',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'radio_btn',
				'display_name' => '是否可读',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '{ 
					"options" : {
						"1": "是",
						"0": "否"
					},
					"default": "0",
				    "checked" : "true"
	            }'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'edit',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'radio_btn',
				'display_name' => '是否可编辑',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '{ 
					"options" : {
						"1": "是",
						"0": "否"
					},
					"default": "0",
				    "checked" : "true"
	            }'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'add',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'radio_btn',
				'display_name' => '是否可添加',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '{ 
					"options" : {
						"1": "是",
						"0": "否"
					},
					"default": "0",
				    "checked" : "true"
	            }'
			])->save();
		}


		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'delete',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'radio_btn',
				'display_name' => '是否可删除',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '{ 
					"options" : {
						"1": "是",
						"0": "否"
					},
					"default": "0",
				    "checked" : "true"
	            }'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'show',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'radio_btn',
				'display_name' => '是否展示',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '{ 
					"options" : {
						"1": "是",
						"0": "否"
					},
					"default": "0",
				    "checked" : "true"
	            }'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'search',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'radio_btn',
				'display_name' => '是否可查询',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '{ 
					"options" : {
						"1": "是",
						"0": "否"
					},
					"default": "0",
				    "checked" : "true"
	            }'
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $dataRowDataType->id,
			'field' => 'details',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text_area',
				'display_name' => '扩展配置',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => ''
			])->save();
		}


	}

	public function seedBannersDataRow()
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
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
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

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $bannerDataType->id,
			'field' => 'created_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '创建时间',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $bannerDataType->id,
			'field' => 'updated_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '更新时间',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 0,
				'details' => '',
			])->save();
		}

	}

	public function seedBannerItemsDataRow() {
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
				'browse' => 0,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 1,
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
				'display_name' => '所属图文组',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $bannerItemDataType->id,
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
				'show' => 1,
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
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $bannerItemDataType->id,
			'field' => 'url',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '链接',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
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
				'display_name' => '图片',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
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
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $bannerItemDataType->id,
			'field' => 'parent_id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '父ID',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $bannerItemDataType->id,
			'field' => 'order',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '顺序',
				'required' => 1,
				'browse' => 1,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'show' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $bannerItemDataType->id,
			'field' => 'created_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '创建时间',
				'required' => 0,
				'browse' => 1,
				'read' => 1,
				'edit' => 0,
				'add' => 0,
				'delete' => 1,
				'show' => 1,
				'details' => '',
			])->save();
		}
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $bannerItemDataType->id,
			'field' => 'updated_at',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'timestamp',
				'display_name' => '更新时间',
				'required' => 0,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'show' => 0,
				'details' => '',
			])->save();
		}
	}


	public function seedSettingsDataRow()
	{
		$settingDataType = DataType::where('slug', 'settings')->firstOrFail();
		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $settingDataType->id,
			'field' => 'id',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'PRI',
				'display_name' => 'ID',
				'required' => 1,
				'browse' => 0,
				'read' => 0,
				'edit' => 0,
				'add' => 0,
				'delete' => 0,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $settingDataType->id,
			'field' => 'key',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '键名',
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
			'data_type_id' => $settingDataType->id,
			'field' => 'display_name',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '展示名称',
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
			'data_type_id' => $settingDataType->id,
			'field' => 'value',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '键值',
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
			'data_type_id' => $settingDataType->id,
			'field' => 'details',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '更多',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
			])->save();
		}

		$dataRow = DataRow::firstOrNew([
			'data_type_id' => $settingDataType->id,
			'field' => 'type',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '类型',
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
			'data_type_id' => $settingDataType->id,
			'field' => 'order',
		]);
		if (! $dataRow->exists) {
			$dataRow->fill([
				'type' => 'text',
				'display_name' => '顺序',
				'required' => 0,
				'browse' => 0,
				'read' => 1,
				'edit' => 1,
				'add' => 1,
				'delete' => 1,
				'details' => '',
			])->save();
		}
	}
}
