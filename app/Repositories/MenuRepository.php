<?php

namespace App\Repositories;

use App\Models\Menu;
use Germey\Generator\Common\BaseRepository;

class MenuRepository extends BaseRepository
{
	/**
	 * @var array
	 */
	protected $fieldSearchable = [
		'name',
		'created_at'
	];

	/**
	 * Configure the Model
	 **/
	public function model()
	{
		return Menu::class;
	}

	/**
	 * @param       $name
	 * @param array $columns
	 */
	public function findByNameWithoutFail($name)
	{
		try {
			return Menu::with('items')->whereName($name)->first();
		} catch (Exception $e) {
			return;
		}
	}

}
