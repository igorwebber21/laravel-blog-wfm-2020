<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainController extends Controller
{
    //

    public function index()
    {

       //dd(Str::slug('Привет мир', '-'));
        return view('admin.index');
    }
}
