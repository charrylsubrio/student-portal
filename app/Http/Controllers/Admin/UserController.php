<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ===============================
    // LIST USERS
    // ===============================
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // ===============================
    // SHOW CREATE FORM
    // ===============================
    public function create()
    {
        return view('admin.users.create');
    }

    // ===============================
    // STORE NEW USER
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6| confirmed', // 🔒 password confirmation
            'role' => 'required|in:admin,student',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // 🔒 hashed password
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'User created successfully.');
    }

    // ===============================
    // SHOW EDIT FORM
    // ===============================
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // ===============================
    // UPDATE USER
    // ===============================
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$user->id",
            'role' => 'required|in:admin,student',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully.');
    }

    // ===============================
    // DELETE USER (SECURE)
    // ===============================
    public function destroy(User $user)
    {
        // ❌ Prevent admin from deleting own account
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }
}
