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
        ->get();
        $websites = Website::latest()->limit(5)->get();

        /**
         * Deviding categories per three columns and redricting them to view via arrays
         */
        $categories_per_column = $this->categories_per_column($categories->count());
        $categories_col_1 = array();
        $categories_col_2 = array();
        $categories_col_3 = array();
        $counter = 1;

        foreach ($categories as $category) {
            if($counter <= $categories_per_column) {
                $categories_col_1[] = $category;
                $counter++;
            }
            elseif ($counter > $categories_per_column && $counter <= 2*$categories_per_column) {
                $categories_col_2[] = $category;
                $counter++;
            } else {
                $categories_col_3[] = $category;
            }
        }

        return view('mainpage.welcome', compact('categories', 'categories_col_1', 'categories_col_2', 'categories_col_3', 'websites'));
    }

    private function categories_per_column($categories_number)
    {
        return (int) ceil($categories_number / 3);
    }

}
