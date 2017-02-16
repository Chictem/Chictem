<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
	/**
	 * Auto generated seed file.
	 *
	 * @return void
	 */
	public function run()
	{
		Permission::firstOrCreate([
			'key' => 'browse_admin',
			'table_name' => 'admin',
		]);

		Permission::firstOrCreate([
			'key' => 'browse_database',
			'table_name' => 'admin',
		]);

		Permission::firstOrCreate([
			'key' => 'browse_media',
			'table_name' => 'admin',
		]);

		Permission::firstOrCreate([
			'key' => 'browse_settings',
			'table_name' => 'admin',
		]);

		Permission::generateFor('menus');

		Permission::generateFor('menus_items');

		Permission::generateFor('pages');
		
		Permission::generateFor('banners');
		
		Permission::generateFor('banner_items');

		Permission::generateFor('roles');

		Permission::generateFor('users');

		Permission::generateFor('posts');

		Permission::generateFor('categories');
	}
}
