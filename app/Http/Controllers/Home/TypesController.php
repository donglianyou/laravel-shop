<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypesController extends Controller
{
    public function index()
    {
        return view('home.types');
    }
}
