<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MemberLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemberLoginRequest;

class MemberLoginController extends Controller
{
    /**
     * Log in a user.
     */
    public function login(MemberLoginRequest $request)
    {
        // Check if the request method is POST
        if ($request->isMethod('post')) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'level' => 0
            ];

            $remember = $request->remember_me ? true : false;

            if (Auth::attempt($credentials, $remember)) {
                $user = Auth::user();
                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Invalid email or password'
                ], 401);
            }
        }

        // If request method is not POST, return 405 Method Not Allowed
        return response()->json([
            'message' => 'Method not allowed. Use POST for login.'
        ], 405);
    }

    /**
     * Log out a user.
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Logout successful'
        ], 200);
    }

    /**
     * Return a message indicating the API is working.
     */
    public function index()
    {
        return response()->json([
            'message' => 'API is working'
        ], 200);
    }

    // Placeholder methods for potential future use
    public function create() { }

    public function store(Request $request) { }

    public function show(MemberLogin $memberLogin) { }

    public function edit(MemberLogin $memberLogin) { }

    public function update(Request $request, MemberLogin $memberLogin) { }

    public function destroy(MemberLogin $memberLogin) { }
}
