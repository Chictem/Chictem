<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
	/**
	 * Auto generated seed file.
	 *
	 * @return void
	 */
	public function run()
	{
		if (! User::where('name', 'Admin')->count()) {
			$role = Role::where('name', 'admin')->firstOrFail();

			User::create([
				'name' => 'Admin',
				'email' => 'admin@admin.com',
				'password' => bcrypt('password'),
				'remember_token' => str_random(60),
				'role_id' => $role->id,
			]);
		}

		if (! User::where('name', 'Germey')->count()) {
			$role = Role::where('name', 'admin')->firstOrFail();

			User::create([
				'name' => 'Germey',
				'email' => 'cqc@cuiqingcai.com',
				'password' => bcrypt('123456'),
				'remember_token' => str_random(60),
				'role_id' => $role->id,
			]);
		}
	}
}
