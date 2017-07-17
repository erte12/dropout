<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Website;

class WebsiteController extends Controller
{

    /**
     * Construct with middleware
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('website.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:150',
            'url' => 'required|url|active_url|unique:websites,url|max:100',
            'description' => 'required|min:100|max:1500',
            'subcategory_id' => 'required|integer',
        ]);

        $website = new Website;
        $website->user_id = auth()->user()->id;
        $website->name = $request->name;
        $website->url = $request->url;
        $website->description = $request->description;
        $website->subcategory_id = $request->subcategory_id;
        $website->save();

        $success = true;

        return redirect()->route('home')->with('status', 'Twoja strona została pomyślnie wysłana i pojawi się w katalogu po sprawdzeniu jej przez administratora.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $website = Website::findOrFail($id);
        return view('website.show', compact('website'));
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
