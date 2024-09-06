<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminUserController extends Controller
{
    public function index()
    {
        // Fetch users with role 'admin' and not deleted
        $users = User::where('role', 'admin')->where('is_deleted', 0)->get();
        return view('backend.users.admin.index', compact('users'));
    }

    public function create()
    {
        return view('backend.users.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create($request->all());

        // Mail::to($user->email)->send(new UserRegistered($user));

        // Mail::to('shahzaib1821@gmail.com')->send(new UserRegistered($user));

        return redirect()->route('adminUser.index')->with('status', 'Admin user created successfully and email sent.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        // to get acutal password instead of hashed passwrod
        return view('backend.users.admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate request if needed
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        // Update user
        $user = User::findOrFail($id);
        $user->update($request->all());

        // Redirect to index
        return redirect()->route('adminUser.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->deleted_at = now();
        $user->is_deleted = 1;
        $user->deleted_by = Auth::id();
        $user->save();

        return redirect()->route('adminUser.index');
    }
}
