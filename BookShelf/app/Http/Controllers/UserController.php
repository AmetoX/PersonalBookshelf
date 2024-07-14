<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }
    
    public function register(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255', // Add validation for name
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ], [
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        // Create and save the user
        $user = User::create([
            'name' => $request->name, // Save the name of the user
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect the user after successful registration
        return redirect('/login')->with('success', 'Registration successful! You can now log in.');
    }

    // Method to display the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Method to handle the login form submission
    public function login(Request $request)
    {
        // Validate the login request
        $credentials = $request->validate([
            'emailOrName' => 'required|string', // Ensure the input is a string
            'password' => 'required',
        ]);

        // Determine the login field based on the input
        $isEmail = filter_var($credentials['emailOrName'], FILTER_VALIDATE_EMAIL);
        $loginField = $isEmail ? 'email' : 'name';

        // Set the appropriate credentials based on the determined login field
        $loginCredentials = [
            $loginField => $credentials['emailOrName'], // Use the determined login field
            'password' => $credentials['password'],
        ];

        // Attempt to log the user in
        if (Auth::attempt($loginCredentials)) {
            // Authentication successful

            // Get the authenticated user
            $user = Auth::user();

            // Store user information in the session
            $request->session()->put('user', $user);

            return redirect()->intended('/'); // Redirect to dashboard or another page
        } else {
            // Authentication failed
            return back()->withErrors(['emailOrName' => 'Invalid email, name, or password']);
        }
    }

    public function logout()
    {
        Auth::logout(); // Clear authentication state
        session()->flush(); // Clear all session data
        return redirect('/'); // Redirect to the homepage or any other desired page
    }
}
