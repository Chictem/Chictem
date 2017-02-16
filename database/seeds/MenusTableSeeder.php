<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenusTableSeeder extends Seeder
{
	/**
	 * Auto generated seed file.
	 *
	 * @return void
	 */
	public function run()
	{
		Menu::firstOrCreate([
			'name' => 'admin',
		]);

		Menu::firstOrCreate([
			'name' => 'main',
		]);
	}
}
