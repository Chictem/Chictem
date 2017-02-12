<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMenuAPIRequest;
use App\Http\Requests\API\UpdateMenuAPIRequest;
use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Germey\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MenuController
 * @package App\Http\Controllers\API
 */

class MenuAPIController extends AppBaseController
{
	/** @var  MenuRepository */
	private $menuRepository;

	public function __construct(MenuRepository $menuRepo)
	{
		$this->menuRepository = $menuRepo;
	}

	/**
	 * @param $nameName
	 * @return mixed
	 */
	public function show($menuName)
	{
		$menu = $this->menuRepository->findByNameWithoutFail($menuName);

		if (empty($menu)) {
			return $this->sendError('Menu not found');
		}
		return $this->sendResponse($menu->toArray(), 'Menu retrieved successfully');
	}

}
