<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Website;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name')
        ->with('subcategories')
        ->with('websites')
        ->get();

        $websites = Website::latest()->limit(5)->get();

        return view('mainpage.welcome', compact('categories', 'websites'));
    }
}
