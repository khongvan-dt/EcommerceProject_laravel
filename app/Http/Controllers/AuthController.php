<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function checkLogin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        if ($user->status == 1) {
            return redirect()->route('login')->with('error', 'Your account has been locked due to too many failed login attempts.');
        }

        if (Hash::check($validatedData['password'], $user->password) == false) {
            $user->countLock += 1;
            if ($user->countLock >= 5) {
                $user->status = 1;
                $user->save();
                return redirect()->route('login')->with('error', 'Too many login attempts, your account has been locked.');
            } else {
                $user->save();
                return redirect()->route('login')->with('error', 'Invalid password. You have ' . (5 - $user->countLock) . ' more login attempts.');
            }
        }

        if ($user && Hash::check($validatedData['password'], $user->password)) {
            Auth::login($user);
            if ($user->role == 'ADMIN') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }
    }

    public function checkRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            return redirect()->route('login')->with('success', 'Account created successfully. Please login.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating your account. Please try again.');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
