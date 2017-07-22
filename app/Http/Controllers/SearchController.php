<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Website;

class SearchController extends Controller
{

    public function websites(Request $request)
    {
        $query = $request->input('q');
        $websites = Website::where('active', '=', 1)
        ->where('name', 'like', '%' .$query . '%')
        ->orWhere('url', 'like', '%' .$query . '%')
        ->orWhere('description', 'like', '%' .$query . '%')
        ->paginate(10);

        return view('search.main', compact('query', 'websites'));
    }
}
