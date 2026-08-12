<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $recentLogs = \Spatie\Activitylog\Models\Activity::latest()->take(5)->get();
        return view('superadmin.dashboard', compact('totalUsers', 'totalRoles', 'recentLogs'));
    }

    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);
        return view('superadmin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('superadmin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);
        activity()->performedOn($user)->log('Created user');

        return redirect()->route('superadmin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('superadmin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|exists:roles,name'
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);

        $user->syncRoles([$request->role]);
        activity()->performedOn($user)->log('Updated user');

        return redirect()->route('superadmin.users.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        activity()->performedOn($user)->log('Deleted user');
        $user->delete();

        return redirect()->route('superadmin.users.index')->with('success', 'User berhasil dihapus.');
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:6'
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        activity()->performedOn($user)->log('Reset password for user');

        return redirect()->back()->with('success', 'Password user berhasil direset.');
    }
}
