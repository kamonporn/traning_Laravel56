<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{ 
	public function index()
    {
       // return view('admin.layouts.template');
        return view('admin.user.lists');
    }

    public function demotwo()
    {
        return "Method POST: demotwo";
    }

    public function demothree()
    {
        return "Method GET, POST : demothree";
    }

    public function demofour()
    {
        return "Method GET, POST, PUT/PATCH, DELETE : demofour";
    }


}
