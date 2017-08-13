<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Website;
use App\Tag;
use App\WebsiteEdited;


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
        $categories = Category::orderBy('name')->with('subcategories')->get();
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
            'description' => 'required|min:350|max:1500',
            'subcategory_id' => 'required|exists:subcategories,id',
            'tags' => ['required'],
        ]);

        $website = auth()->user()->websites()->create([
            'name' => $request->name,
            'url' => $request->url,
            'description' => $request->description,
            'subcategory_id' => $request->subcategory_id,
        ]);

        Tag::createTagsForWebsite($request->tags, $website);

        return redirect()->route('home')
        ->with('status', 'Twoja strona została pomyślnie wysłana i pojawi się w katalogu po sprawdzeniu jej przez administratora.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $website = Website::where('active', '=', 1)
        ->where('id', '=', $id)
        ->with('tags')
        ->first();

        if(is_null($website)) {
            abort(404, 'Taka strona nie istnieje');
        }

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
        $website = Website::where('id', $id)->with('tags')->first();
        $categories = Category::orderBy('name')->with('subcategories')->get();
        return view('website.edit', compact('website', 'categories'));
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
        $this->validate($request, [
            'name' => 'required|min:5|max:150',
            'description' => 'required|min:100|max:1500',
            'subcategory_id' => 'required|exists:subcategories,id',
            'tags' => 'required',
        ]);

        // Only superuser is able to modify 'active' column
        if(superuser()) {
            $website = Website::findOrFail($id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'subcategory_id' => $request->subcategory_id,
                'active' => $request->accept,
            ]);
            return back();

        } else {
            $website = Website::findOrFail($id);

            if($website->active == 0) {
                $website->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'subcategory_id' => $request->subcategory_id,
                ]);
            } else {
                $website_edited = WebsiteEdited::updateOrCreate([
                    'url' => $website->url,
                ], [
                    'website_id' => $website->id,
                    'user_id' => $website->user_id,
                    'name' => $request->name,
                    'description' => $request->description,
                    'subcategory_id' => $request->subcategory_id,
                    'tags' => json_encode($request->tags),
                ]);
            }
        }

        return redirect()->route('panel.user.websites');
    }

    /**
     * Remove the specified resource from storage (softdeleting)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $website = Website::findOrFail($id)->delete();

        if(superuser()) {
            return redirect()->route('panel');
        }
        return redirect()->route('panel.user.websites');
    }

    /**
     * Remove the specified resource from storage (hardeleting).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_forever($id)
    {
        $website = Website::withTrashed()->findOrFail($id)->forceDelete();
        if(superuser()) {
            return redirect()->route('panel.admin.websites.waiting');
        }
        return redirect()->route('panel.user.websites');
    }
}
