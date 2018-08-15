<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function adminIndex()
    {
        return view('backend.home');
    }
}
