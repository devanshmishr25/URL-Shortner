<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $shortUrls = [];

        if ($user->isSuperAdmin()) {
            return view('dashboard.super-admin', ['user' => $user]);
        } elseif ($user->isAdmin()) {
            $shortUrls = $user->company->shortUrls()->paginate(10);
            return view('dashboard.admin', ['user' => $user, 'shortUrls' => $shortUrls]);
        } elseif ($user->isMember()) {
            $shortUrls = $user->shortUrls()->paginate(10);
            return view('dashboard.member', ['user' => $user, 'shortUrls' => $shortUrls]);
        }

        return view('dashboard.default', ['user' => $user]);
    }
}
