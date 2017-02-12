<?php

use App\Models\BannerItem;
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
		$banner = Banner::where('name', 'example')->firstOrFail();

		$bannerItem = BannerItem::firstOrNew([
			'banner_id' => $banner->id,
			'name' => '子图1',
		]);
		if (! $bannerItem->exists) {
			$bannerItem->fill([
				'url' => 'http://www.baidu.com',
				'image_url' => 'https://ww1.sinaimg.cn/large/006tNc79ly1fco496ea5pj31c60xyjs8.jpg'
			]);
			$bannerItem->save();
		}

		$bannerItem = BannerItem::firstOrNew([
			'banner_id' => $banner->id,
			'name' => '子图2',
		]);

		if (! $bannerItem->exists) {
			$bannerItem->fill([
				'url' => 'http://www.jd.com',
				'image_url' => 'https://ww1.sinaimg.cn/large/006tNc79ly1fco49b52taj31d410wq6v.jpg'
			])->save();
		}
	}
}
