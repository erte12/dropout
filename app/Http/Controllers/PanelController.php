<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Website;
use App\WebsiteEdited;
use App\User;

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
        $websites = auth()->user()->websites();
        return view('panel.user.websites', compact('websites'));
    }

    /**
     * Show the waiting websites
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_websites_waiting()
    {
        $websites = Website::where('active', 0)->get();
        return view('panel.admin.websites', compact('websites'));
    }

    /**
     * Show the websites in edit
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_websites_edited()
    {
        $websites = WebsiteEdited::get();
        return view('panel.admin.websites', compact('websites'));
    }

    /**
     * Show the accepted websites
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_websites_accepted()
    {
        $websites = Website::where('active', 1)->get();
        return view('panel.admin.websites', compact('websites'));
    }

    /**
     * Show the deleted websites
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_websites_deleted()
    {
        $websites = Website::onlyTrashed()->get();
        return view('panel.admin.websites', compact('websites'));
    }

    /**
     * Show the deleted websites
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_users()
    {
        $users = User::where('role_id', '!=', 1)->get();
        return view('panel.admin.users', compact('users'));
    }

}
