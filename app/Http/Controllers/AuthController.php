<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function loginPage()
    {
        return view('auth.login');
    }
    function signupPage()
    {
        return view('auth.signup');
    }

    function login(Request $request)
    {
    $userDetails = [
        "email" => $request->email,
        "password" => $request->password
    ];

    if (Auth::attempt($userDetails)) {
        $request->session()->regenerate();
        return redirect('/');
    }
    return back();
    }

    function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ],[
            'name.required' =>'Name field cannot be empty',
            'email.required' =>'Email field cannot be empty',
            'email.email' =>'Invalid Email Address',
            'password.required' => 'Password field cannot be empty',
            'password.min' => 'Password must be at least 6 characters long.',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect('/recipesbook/signup')->withErrors(['email' => 'This email is already registered.']);
        }

        // If user doesn't exist, create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id, 
        ]);

        return redirect('/recipesbook/login')->with('success', "Account has been created!");
    }


    function logout(Request $request)
    {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/recipesbook/login');
    }


}
