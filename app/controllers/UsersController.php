<?php

namespace App\Controllers;

class UsersController extends Controller
{
    public function index()
    {
        echo view('user');
    }
}
