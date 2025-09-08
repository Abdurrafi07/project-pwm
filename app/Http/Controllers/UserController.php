<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class UserController extends Controller
{
    public function dashboard(): View
    {
        return view('user.dashboard');
    }
}