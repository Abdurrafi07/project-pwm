<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // penting
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserAksesController extends Controller
{
    // Index menggantikan dashboard
    public function index(): View
    {
        $pendingUsers = User::where('is_approved', false)->count();
        $totalUsers   = User::where('role_id', '!=', auth()->user()->role_id)->count();
        
        return view('admin.users.index', compact('pendingUsers', 'totalUsers'));
    }

    public function pendingUsers(): View
    {
        $users = User::with('role')
            ->where('is_approved', false)
            ->latest()
            ->paginate(10);
            
        return view('admin.users.verifikasi', compact('users'));
    }

    public function allUsers(): View
    {
        $users = User::with('role')
            ->where('id', '!=', auth()->id())
            ->latest()
            ->paginate(10);
            
        return view('admin.users.pengguna', compact('users'));
    }

    // =========================
    // Tambah akun baru
    // =========================
    public function create(): View
    {
        return view('admin.users.create'); // buat blade create form
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => ['required', 'confirmed', Password::defaults()],
            'role_id'   => 'required|exists:roles,id',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role_id'   => $request->role_id,
            'is_approved' => true,
            'approved_at' => now(),
            'approved_by' => auth()->id(),
            'is_active'  => true,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User account created successfully!');
    }

    // =========================
    // Approve / Reject / Activate / Deactivate / Delete
    // =========================
    public function approveUser(User $user)
    {
        $user->update([
            'is_approved' => true,
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'User approved successfully!');
    }

    public function rejectUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User rejected and removed!');
    }

    public function deactivateUser(User $user)
    {
        $user->update(['is_active' => false]);
        return redirect()->back()->with('success', 'User account has been deactivated!');
    }

    public function activateUser(User $user)
    {
        $user->update(['is_active' => true]);
        return redirect()->back()->with('success', 'User account has been re-activated!');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User account deleted permanently!');
    }
}
