<?php

use Illuminate\Database\Seeder;
use App\Traits\Seedable;

class VoyagerDummyDatabaseSeeder extends Seeder
{
	use Seedable;

	protected $seedersPath = __DIR__ . '/';

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('CategoriesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('PostsTableSeeder');
		$this->call('PagesTableSeeder');
		$this->call('SettingsTableSeeder');
		$this->call('BannersTableSeeder');
		$this->call('BannerItemsTableSeeder');
	}
}
