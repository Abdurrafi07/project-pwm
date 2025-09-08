<?php

namespace App\Http\Controllers\NoAuth;

use App\Http\Controllers\Controller; // ← ini penting
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function pendingApproval()
    {
        return view('auth.pending-approval');
    }

    public function registrationSuccess()
    {
        return view('auth.registration-success');
    }
}