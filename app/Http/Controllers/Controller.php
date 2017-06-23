<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The kind of theme use by this project
     * @var string
     */
    protected $theme = "theme-red";

    /**
     * Return the name of the theme
     *
     * @return string
     */
    protected function getTheme()
    {
        return $this->theme;
    }
}
