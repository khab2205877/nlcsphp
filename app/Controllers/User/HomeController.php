<?php

namespace App\Controllers\User;


class HomeController extends Controller
{
    public function index()
    {
       $this->sendPage('pages/index');
    }
}
