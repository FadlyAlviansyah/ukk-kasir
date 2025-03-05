<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email:dns',
            'name' => 'required',
            'role' => 'required|in:admin,cashier',
            'password' => 'required'
        ]);

        User::create([
            'email' => $validatedData['email'],
            'name' => $validatedData['name'],
            'role' => $validatedData['role'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('user.home')->with('added', 'Employee added successfully!');
    }

    public function edit(User $user, $id)
    {
        $user = User::find($id);
        return view('pages.user.edit', compact('user'));
    }
    public function update(Request $request, User $user, $id)
    {
        $validation = [
            'email' => 'required|email:dns',
            'name' => 'required',
            'role' => 'required|in:admin,cashier',
        ];

        $validatedData = $request->validate($validation);

        if ($request->password) {
            $validatedData['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($validatedData);

        return redirect()->route('user.home')->with('updated', 'User updated successfully!');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'User deleted successfully!');
    }
}
