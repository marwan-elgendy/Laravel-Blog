<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\category;

use App\post;

use App\tag;

class WelcomeController extends Controller
{
    public function index(){


        return view('welcome')
        ->with('categories',category::all())
        ->with('posts',post::all())
        ->with('tags',tag::all())
        ->with('posts',post::Searched()->simplePaginate(4));
    }
}
