<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $setting = Setting::firstOrNew([
            'key'          => 'title',
        ]);
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '站点标题',
                'value'        => 'Site Title',
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
            ])->save();
        }

        $setting = Setting::firstOrNew([
            'key'          => 'description',
        ]);
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '站点描述',
                'value'        => 'Site Description',
                'details'      => '',
                'type'         => 'text',
                'order'        => 2,
            ])->save();
        }
	    

        $setting = Setting::firstOrNew([
            'key'          => 'admin_bg_image',
        ]);
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '管理后台背景图',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 9,
            ])->save();
        }

        $setting = Setting::firstOrNew([
            'key'          => 'admin_title',
        ]);
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '管理后台标题',
                'value'        => 'Voyager',
                'details'      => '',
                'type'         => 'text',
                'order'        => 4,
            ])->save();
        }

        $setting = Setting::firstOrNew([
            'key'          => 'admin_description',
        ]);
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '管理后台描述',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 5,
            ])->save();
        }

        $setting = Setting::firstOrNew([
            'key'          => 'admin_loader',
        ]);
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '管理后台加载图',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 6,
            ])->save();
        }

        $setting = Setting::firstOrNew([
            'key'          => 'admin_icon_image',
        ]);
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => '管理后台LOGO',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 7,
            ])->save();
        }
    }
}
