<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.welcome');
    }

    /**
     * Show the user's websites (active, inactive and in edit)
     *
     * @return \Illuminate\Http\Response
     */
    public function user_websites()
    {
        return view('panel.user.websites');
    }
}
