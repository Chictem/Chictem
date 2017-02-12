<?php

namespace App\Components;

use App\Utilities\Alert;

abstract class AbstractComponent implements ComponentInterface
{
    protected $alert;

    public function setAlert(Alert $alert)
    {
        $this->alert = $alert;

        return $this;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->alert, $name], $arguments);
    }
}
