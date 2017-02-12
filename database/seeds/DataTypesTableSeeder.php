<?php

use Illuminate\Database\Seeder;
use App\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
	/**
	 * Auto generated seed file.
	 *
	 * @return void
	 */
	public function run()
	{
		$dataType = DataType::firstOrNew([
			'slug' => 'posts',
		]);
		if (! $dataType->exists) {
			$dataType->fill([
				'name' => 'posts',
				'display_name_singular' => '内容',
				'display_name_plural' => '内容',
				'icon' => 'voyager-news',
				'model_name' => 'App\\Models\\Post',
				'generate_permissions' => 1,
				'description' => '',
			])->save();
		}

		$dataType = DataType::firstOrNew([
			'slug' => 'pages',
		]);
		if (! $dataType->exists) {
			$dataType->fill([
				'name' => 'pages',
				'display_name_singular' => '页面',
				'display_name_plural' => '页面',
				'icon' => 'voyager-file-text',
				'model_name' => 'App\\Models\\Page',
				'generate_permissions' => 1,
				'description' => '',
			])->save();
		}

		$dataType = DataType::firstOrNew([
			'slug' => 'users',
		]);
		if (! $dataType->exists) {
			$dataType->fill([
				'name' => 'users',
				'display_name_singular' => '用户',
				'display_name_plural' => '用户',
				'icon' => 'voyager-person',
				'model_name' => 'App\\Models\\User',
				'generate_permissions' => 1,
				'description' => '',
			])->save();
		}

		$dataType = DataType::firstOrNew([
			'name' => 'categories',
		]);
		if (! $dataType->exists) {
			$dataType->fill([
				'slug' => 'categories',
				'display_name_singular' => '分类',
				'display_name_plural' => '分类',
				'icon' => 'voyager-categories',
				'model_name' => 'App\\Models\\Category',
				'generate_permissions' => 1,
				'description' => '',
			])->save();
		}

		$dataType = DataType::firstOrNew([
			'slug' => 'menus',
		]);
		if (! $dataType->exists) {
			$dataType->fill([
				'name' => 'menus',
				'display_name_singular' => '菜单',
				'display_name_plural' => '菜单',
				'icon' => 'voyager-list',
				'model_name' => 'App\\Models\\Menu',
				'generate_permissions' => 1,
				'description' => '',
			])->save();
		}

		$dataType = DataType::firstOrNew([
			'slug' => 'roles',
		]);
		if (! $dataType->exists) {
			$dataType->fill([
				'name' => 'roles',
				'display_name_singular' => '角色',
				'display_name_plural' => '角色',
				'icon' => 'voyager-lock',
				'model_name' => 'App\\Models\\Role',
				'generate_permissions' => 1,
				'description' => '',
			])->save();
		}

		$dataType = DataType::firstOrNew([
			'slug' => 'banners',
		]);
		if (! $dataType->exists) {
			$dataType->fill([
				'name' => 'banners',
				'display_name_singular' => '图文',
				'display_name_plural' => '图文',
				'icon' => 'voyager-photo',
				'model_name' => 'App\\Models\\Banner',
				'generate_permissions' => 1,
				'description' => '图文',
			])->save();
		}

		$dataType = DataType::firstOrNew([
			'slug' => 'banner_items',
		]);
		if (! $dataType->exists) {
			$dataType->fill([
				'name' => 'banner_items',
				'display_name_singular' => '图文项',
				'display_name_plural' => '图文项',
				'icon' => 'voyager-photo',
				'model_name' => 'App\\Models\\BannerItem',
				'generate_permissions' => 1,
				'description' => '图文项',
			])->save();
		}

		$dataType = DataType::firstOrNew([
			'slug' => 'data_rows',
		]);
		if (! $dataType->exists) {
			$dataType->fill([
				'name' => 'data_rows',
				'display_name_singular' => '数据结构',
				'display_name_plural' => '数据结构',
				'icon' => 'voyager-bar-chart',
				'model_name' => 'App\\Models\\DataRow',
				'generate_permissions' => 1,
				'description' => '数据结构',
			])->save();
		}

		$dataType = DataType::firstOrNew([
			'slug' => 'settings',
		]);
		if (! $dataType->exists) {
			$dataType->fill([
				'name' => 'settings',
				'display_name_singular' => '设置',
				'display_name_plural' => '设置',
				'icon' => 'voyager-settings',
				'model_name' => 'App\\Models\\Setting',
				'generate_permissions' => 1,
				'description' => '设置',
			])->save();
		}
	}
}
