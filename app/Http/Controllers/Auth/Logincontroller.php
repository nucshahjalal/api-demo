<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('auth.login',compact('users'));
    }

    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required',
        'password' => 'required',
        ], [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            if ($user->name === 'admin') {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/user-list');
            }
        }

        return back()->withErrors([
            'password' => 'Invalid Email Or Password',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
