<?php

namespace App\Controllers\Admin;

use App\Models\User;

class AdminController extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function users()
  {
    $userpdo = new User(PDO());
    $users = $userpdo->all();

    $this->sendPage('page/user', [
      'users' => $users
    ]);
  }
}
