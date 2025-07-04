<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginAction(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            Alert::success('Login Successful', 'Welcome back!');
            return redirect()->route('dashboard');
        }
        Alert::error('Login Failed', 'Invalid credentials provided.');
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        Auth::logout();
        Alert::success('Logout Berhasil', 'Anda telah berhasil keluar.');
        return redirect()->route('login');
    }

    public function dashboard()
    {

        $users = User::all();
        return view('layouts.dashboard', compact('users'));
    }

    public function profile()
    {
        return view('layouts.user.profile');
    }
}

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use RealRashid\SweetAlert\Facades\Alert;

// class AuthController extends Controller
// {
//     public function login()
//     {
//         return view('login');
//     }

//     public function loginAction(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required|min:6',
//         ]);

//         if (Auth::attempt($request->only('email', 'password'))) {
//             Alert::success('Login Successful', 'Welcome back!');
//             return redirect()->route('dashboard');
//         }
//         Alert::error('Login Failed', 'Invalid credentials provided.');
//         return redirect()->back()->withInput();
//     }

//     public function logout()
//     {
//         Auth::logout();
//         Alert::success('Logged Out', 'You have been logged out successfully.');
//         return redirect()->route('login')->with('status', 'You have been logged out successfully.');
//     }

//     public function dashboard()
//     {
//         $users = User::all();
//         return view('layouts.dashboard', compact('users'));
//     }
// }
