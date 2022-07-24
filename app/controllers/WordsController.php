<?php

namespace App\Controllers;

class WordsController extends Controller
{
    public function index()
    {
        echo view('word');
    }
}
