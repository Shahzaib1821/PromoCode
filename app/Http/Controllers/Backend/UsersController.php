<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('backend.pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('backend.pages.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));

        User::create($data);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.pages.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->input('password'))]);
        }

        $user->update($request->all());

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        //softdelete
        $user = User::find($id);
        $user->deleted_by = Auth::id();
        $user->is_deleted = 1;
        $user->save();

        return redirect()->route('users.index');
    }
}
