<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The pre name of front view
     *
     * @var array
     */
    protected $front = 'front';

    /**
     * The pre name of manage view
     *
     * @var array
     */
    protected $manage = 'manage';

    /**
     * Get Name of Front View
     *
     * @return ViewName
     */
    public function getFrontView($name, $space = null)
    {
        return $this->front . "." . ($space ? $space : $this->space) . "." . $name;
    }

    /**
     * Get Name of Manage View
     *
     * @return ViewName
     */
    public function getManageView($name, $space = null)
    {
        return $this->manage . "." . ($space ? $space : $this->space) . "." . $name;
    }

}
