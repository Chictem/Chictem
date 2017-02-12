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
		$setting = Banner::firstOrNew([
			'name' => 'example',
		]);
		if (! $setting->exists) {
			$setting->fill([
				'title' => '测试图集',
			])->save();
		}

	}
}
