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
            'slug'                  => 'posts',
        ]);
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'posts',
                'display_name_singular' => '内容',
                'display_name_plural'   => '内容',
                'icon'                  => 'voyager-news',
                'model_name'            => 'App\\Models\\Post',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = DataType::firstOrNew([
            'slug'                  => 'pages',
        ]);
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'pages',
                'display_name_singular' => '页面',
                'display_name_plural'   => '页面',
                'icon'                  => 'voyager-file-text',
                'model_name'            => 'App\\Models\\Page',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = DataType::firstOrNew([
            'slug'                  => 'users',
        ]);
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => '用户',
                'display_name_plural'   => '用户',
                'icon'                  => 'voyager-person',
                'model_name'            => 'App\\Models\\User',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = DataType::firstOrNew([
            'name'                  => 'categories',
        ]);
        if (!$dataType->exists) {
            $dataType->fill([
                'slug'                  => 'categories',
                'display_name_singular' => '分类',
                'display_name_plural'   => '分类',
                'icon'                  => 'voyager-categories',
                'model_name'            => 'App\\Models\\Category',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = DataType::firstOrNew([
            'slug'                  => 'menus',
        ]);
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => '菜单',
                'display_name_plural'   => '菜单',
                'icon'                  => 'voyager-list',
                'model_name'            => 'App\\Models\\Menu',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = DataType::firstOrNew([
            'slug'                  => 'roles',
        ]);
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => '角色',
                'display_name_plural'   => '角色',
                'icon'                  => 'voyager-lock',
                'model_name'            => 'App\\Models\\Role',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

	    $dataType = DataType::firstOrNew([
		    'slug'                  => 'courses',
	    ]);
	    if (!$dataType->exists) {
		    $dataType->fill([
			    'name'                  => 'courses',
			    'display_name_singular' => '课程',
			    'display_name_plural'   => '课程',
			    'icon'                  => 'voyager-news',
			    'model_name'            => 'App\\Models\\Course',
			    'generate_permissions'  => 1,
			    'description'           => '安全教育培训课程',
		    ])->save();
	    }

	    $dataType = DataType::firstOrNew([
		    'slug'                  => 'teachers',
	    ]);
	    if (!$dataType->exists) {
		    $dataType->fill([
			    'name'                  => 'teachers',
			    'display_name_singular' => '讲师',
			    'display_name_plural'   => '讲师',
			    'icon'                  => 'voyager-person',
			    'model_name'            => 'App\\Models\\Teacher',
			    'generate_permissions'  => 1,
			    'description'           => '讲师',
		    ])->save();
	    }

	    $dataType = DataType::firstOrNew([
		    'slug'                  => 'experts',
	    ]);
	    if (!$dataType->exists) {
		    $dataType->fill([
			    'name'                  => 'experts',
			    'display_name_singular' => '专家',
			    'display_name_plural'   => '专家',
			    'icon'                  => 'voyager-person',
			    'model_name'            => 'App\\Models\\Expert',
			    'generate_permissions'  => 1,
			    'description'           => '专家',
		    ])->save();
	    }

	    $dataType = DataType::firstOrNew([
		    'slug'                  => 'companies',
	    ]);
	    if (!$dataType->exists) {
		    $dataType->fill([
			    'name'                  => 'companies',
			    'display_name_singular' => '公司',
			    'display_name_plural'   => '公司',
			    'icon'                  => 'voyager-news',
			    'model_name'            => 'App\\Models\\Company',
			    'generate_permissions'  => 1,
			    'description'           => '公司',
		    ])->save();
	    }

        $dataType = DataType::firstOrNew([
            'slug'                  => 'banners',
        ]);
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'banners',
                'display_name_singular' => '图文',
                'display_name_plural'   => '图文',
                'icon'                  => 'voyager-photo',
                'model_name'            => 'App\\Models\\Banner',
                'generate_permissions'  => 1,
                'description'           => '图文',
            ])->save();
        }

	    $dataType = DataType::firstOrNew([
		    'slug'                  => 'data_rows',
	    ]);
	    if (!$dataType->exists) {
		    $dataType->fill([
			    'name'                  => 'data_rows',
			    'display_name_singular' => '数据结构',
			    'display_name_plural'   => '数据结构',
			    'icon'                  => 'voyager-bar-chart',
			    'model_name'            => 'App\\Models\\DataRow',
			    'generate_permissions'  => 1,
			    'description'           => '数据结构',
		    ])->save();
	    }
    }
}
