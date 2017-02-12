<?php

namespace App\Repositories;

use App\Models\Setting;
use Germey\Generator\Common\BaseRepository;

class SettingRepository extends BaseRepository
{
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'key',
		'display_name',
		'value',
		'details',
		'type'
	];

	/**
	 * Configure the Model
	 **/
	public function model()
	{
		return Setting::class;
	}
}
