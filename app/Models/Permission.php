<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $guarded = [];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function roles()
	{
		return $this->hasMany(Role::class);
	}

	/**
	 * @param $table_name
	 */
	public static function generateFor($table_name)
	{
		self::firstOrCreate(['key' => 'browse_' . $table_name, 'table_name' => $table_name]);
		self::firstOrCreate(['key' => 'read_' . $table_name, 'table_name' => $table_name]);
		self::firstOrCreate(['key' => 'edit_' . $table_name, 'table_name' => $table_name]);
		self::firstOrCreate(['key' => 'add_' . $table_name, 'table_name' => $table_name]);
		self::firstOrCreate(['key' => 'delete_' . $table_name, 'table_name' => $table_name]);
		self::firstOrCreate(['key' => 'own_' . $table_name, 'table_name' => $table_name]);
	}

	/**
	 * @param $table_name
	 */
	public static function removeFrom($table_name)
	{
		self::where(['table_name' => $table_name])->delete();
	}
}
