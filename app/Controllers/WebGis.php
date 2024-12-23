<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class WebGis extends BaseController
{
    public function home():string
    {
        return view('templates/index');
    }

    public function about():string{
        return view('templates/about');
    }

    public function maps():string{
        return view('templates/maps');
    }
}
