<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);
        confirmDelete('Delete User!', 'Yakin ingin menghapus user ini?');
        return view('layouts.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name'            => 'required|string|max:255',
                'email'           => 'required|string|email|max:255|unique:users',
                'password'        => 'required|string|min:8',
                'role'            => 'required|in:admin,mentor,user',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }
        $validate['password'] = bcrypt($validate['password']);
        $createUser = User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'password'        => bcrypt($request->password),
            'role'            => $request->role,
            'profile_picture' => $request->file('profile_picture') ? $request->file('profile_picture')->store('profile_pictures', 'public') : null,
        ]);
        if (!$createUser) {
            Alert::error('Error', 'Failed to create user.');
            return redirect()->back();
        }

        Alert::success('Success', 'User created successfully.');
        return redirect()->route('user.index');
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $validate = $request->validate([
                'name'            => 'required|string|max:255',
                'email'           => 'required|string|email|max:255|unique:users,email,' . $id,
                'password'        => 'nullable|string|min:8',
                'role'            => 'required|in:admin,mentor,user',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($request->hasFile('profile_picture')) {
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
                $validate['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
            } else {
                $validate['profile_picture'] = $user->profile_picture; // Keep the old profile picture if not updated
            }
            $validate['password'] = bcrypt($validate['password']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }
        $updateUser = $user->update($validate);
        if(!$updateUser) {
            Alert::error('Error', 'Failed to update user.');
            return redirect()->back();
        }

        Alert::success('Success', 'User updated successfully.');
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Error', 'User not found.');
            return redirect()->back();
        }
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        if (!$user->delete()) {
            Alert::error('Error', 'Failed to delete user.');
            return redirect()->back();
        }
        Alert::success('Success', 'User deleted successfully.');
        return redirect()->route('user.index');
    }
}
