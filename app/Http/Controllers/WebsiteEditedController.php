<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Website;
use App\WebsiteEdited;
use App\Category;
use App\Tag;

class WebsiteEditedController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $website = WebsiteEdited::findOrFail($id);
        $categories = Category::orderBy('name')->with('subcategories')->get();
        return view('website.edited.edit', compact('website', 'categories'));
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

        if(superuser() && $request->accept == 1) {
            $website_request = WebsiteEdited::findOrFail($id);

            $edit_success = Website::findOrFail($website_request->website_id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'subcategory_id' => $request->subcategory_id,
            ]);

            if($edit_success) {
                $website_request->delete();
            }

            return redirect()->route('panel');
        } else {

            WebsiteEdited::findOrFail($id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'subcategory_id' => $request->subcategory_id,
                'tags' => json_encode($request->tags),
            ]);

        }

        if(superuser()) {
            return back();
        }

        return redirect()->route('panel.user.websites');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $website = WebsiteEdited::findOrFail($id)->delete();

        if(superuser()) {
            return redirect()->route('panel');
        }
        return redirect()->route('panel.user.websites');
    }
}
