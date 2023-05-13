<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request_login = $request->only('user_email','password');

        if (empty($request->get('user_email')) && empty($request->get('password'))) {
            return response()->json(['success' => 0, 'message' => 'Email and Password cannot be empty!'], 500);
        }

        if (!Auth::attempt($request_login)) {
            return response()->json(['success' => 0, 'message' => 'Incorrect email or password!'], 401);
        }

        return response()->json(['success' => 1, 'message' => 'Success login.'], 200);
    }

    public function logout(Request $request)
    {
        if(Auth::check()) {
            Auth::logout(true);
        }
        return redirect()->route('login');
    }
}
