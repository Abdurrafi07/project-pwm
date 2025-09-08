<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        
        // Authenticate user
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $user = Auth::user();

        // Check if user is approved
        if (!$user->isApproved()) {
            Auth::logout();
            return redirect()->route('pending-approval');
        }

        // Generate JWT token
        $token = JWTAuth::fromUser($user);
        session(['jwt_token' => $token]);

        $request->session()->regenerate();

        // Redirect based on role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        // Invalidate JWT token
        if (session('jwt_token')) {
            try {
                JWTAuth::invalidate(session('jwt_token'));
            } catch (\Exception $e) {
                // Token already invalid
            }
            session()->forget('jwt_token');
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}