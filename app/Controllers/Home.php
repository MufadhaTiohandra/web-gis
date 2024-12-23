<?php

namespace App\Controllers;

use PHPUnit\Util\PHP\PhpProcessException;

class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard');
    }
    public function about(): string
    {
        return view('maps/viewmaps');
    }

    public function test(): string
    {
        return view('layouts/try');
    }
}
