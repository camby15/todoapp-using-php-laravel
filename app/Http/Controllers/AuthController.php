<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    // Register a new user and issue a token
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        if ($request->expectsJson()){
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        // Redirect to login page with a success message
        return redirect('/login')->with('message', 'Registration successful. Please log in.');
    }

    // Login an existing user and issue a token
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        if ($request->expectsJson()){
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
        

         // Log the user in
        Auth::login($user);
        // Redirect to the ToDo page
        return redirect()->route('todo.index');

    }

    // Logout and revoke the token
    public function logout()
    {
        // Revoke the Sanctum token if you're using token-based authentication
        Auth::user()->tokens()->delete();                     
        // This is for token-based authentication for protecting the routes from external access.

        // Invalidate the session
        Session::invalidate();

        // Regenerate the CSRF token
        Session::regenerateToken();

        // Redirect to the login page with a success message
        Session::flash('alert-success', 'You have been successfully logged out.');
        return redirect()->route('login');
    }

    // Show login form (for web)
    public function showLogin()
    {
        return view('auth.login');
    }

    // Show register form (for web)
    public function showRegister()
    {
        return view('auth.register');
    }
}

