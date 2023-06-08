<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request){
        info(session()->all());
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        } else {
            return redirect()->route('login')->with('error', 'Invalid Credentials');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
