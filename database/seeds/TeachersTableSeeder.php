<?php

use App\Models\DataRow;
use App\Models\DataType;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $teacherDataType = DataType::where('slug', 'teachers')->firstOrFail();
	    $dataRow = DataRow::firstOrNew([
		    'data_type_id' => $teacherDataType->id,
		    'field' => 'id',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'PRI',
			    'display_name' => 'ID',
			    'required' => 1,
			    'browse' => 0,
			    'read' => 1,
			    'edit' => 1,
			    'add' => 0,
			    'delete' => 1,
			    'details' => '',
		    ])->save();
	    }

	    $dataRow = DataRow::firstOrNew([
		    'data_type_id' => $teacherDataType->id,
		    'field' => 'name',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'text',
			    'display_name' => '讲师姓名',
			    'required' => 1,
			    'browse' => 1,
			    'read' => 1,
			    'edit' => 1,
			    'add' => 1,
			    'delete' => 1,
			    'details' => '',
		    ])->save();
	    }

	    $dataRow = DataRow::firstOrNew([
		    'data_type_id' => $teacherDataType->id,
		    'field' => 'image',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'image',
			    'display_name' => '讲师照片',
			    'required' => 0,
			    'browse' => 1,
			    'read' => 1,
			    'edit' => 1,
			    'add' => 1,
			    'delete' => 1,
			    'details' => '',
		    ])->save();
	    }

	    $dataRow = DataRow::firstOrNew([
		    'data_type_id' => $teacherDataType->id,
		    'field' => 'description',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'text_area',
			    'display_name' => '介绍',
			    'required' => 0,
			    'browse' => 1,
			    'read' => 1,
			    'edit' => 1,
			    'add' => 1,
			    'delete' => 1,
		    ])->save();
	    }

	    $dataRow = DataRow::firstOrNew([
		    'data_type_id' => $teacherDataType->id,
		    'field' => 'job',
	    ]);
	    if (! $dataRow->exists) {
		    $dataRow->fill([
			    'type' => 'text',
			    'display_name' => '工作单位',
			    'required' => 0,
			    'browse' => 1,
			    'read' => 1,
			    'edit' => 1,
			    'add' => 1,
			    'delete' => 1,
			    'details' => '',
		    ])->save();
	    }

	    $teacher = Teacher::firstOrNew([
		    'name' => '王恩达',
	    ]);
	    if (! $teacher->exists) {
		    $teacher->fill([
			    'image' => '/storage/users/default.png',
			    'description' => '德上智慧首席讲师, 曾主讲多次安全教育课程',
			    'job' => '德上智慧首席讲师',
		    ])->save();
	    }

	    $teacher = Teacher::firstOrNew([
		    'name' => '李荣光',
	    ]);
	    if (! $teacher->exists) {
		    $teacher->fill([
			    'image' => '/storage/users/default.png',
			    'description' => '前启明高级安全员, 曾主讲多次安全教育课程',
			    'job' => '置云科技首席讲师',
		    ])->save();
	    }
    }
}
