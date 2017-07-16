<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $subcategories = $category->subcategories;
        $websites = $category->websites()->paginate(10);

        /**
         * Deviding categories per two columns and redricting them to view via two arrays
         */
        $subcategories_per_column = $this->categories_per_column($subcategories->count());
        $subcategories_col_1 = array();
        $subcategories_col_2 = array();
        $subcategories_col_3 = array();
        $counter = 1;

        foreach ($subcategories as $subcategory) {
            if($counter <= $subcategories_per_column) {
                $subcategories_col_1[] = $subcategory;
                $counter++;
            }
            elseif ($counter > $subcategories_per_column && $counter <= 2*$subcategories_per_column) {
                $subcategories_col_2[] = $subcategory;
                $counter++;
            } else {
                $subcategories_col_3[] = $subcategory;
            }
        }

        return view('category.main', compact('category', 'subcategories_col_1', 'subcategories_col_2', 'subcategories_col_3', 'websites'));
    }

    /**
     * Counts how many categories should be in one column
     * @param  int $categories_number
     * @return int
     */
    private function categories_per_column($categories_number)
    {
        return (int) ceil($categories_number / 3);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
