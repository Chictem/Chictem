<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('roles')->delete();
        Role::create([
            'name' => 'admin',
            'display_name' => '管理员',
            'description' => '站点管理员',
        ]);
        Role::create([
            'name' => 'editor',
            'display_name' => '编辑',
            'description' => '站点编辑人员',
        ]);
        Role::create([
            'name' => 'individual',
            'display_name' => '普通用户',
            'description' => '普通用户人员',
        ]);
        Role::create([
            'name' => 'enterprise',
            'display_name' => '企业用户',
            'description' => '企业用户',
        ]);
        Role::create([
            'name' => 'contributor',
            'display_name' => '投稿者',
            'description' => '投稿者',
        ]);
	}

}