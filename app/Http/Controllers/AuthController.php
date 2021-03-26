<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Configurations;

class AuthController extends Controller
{
    
    public function loginForm() 
    {
        return view('auth.login');
    }
    
    public function login(Request $request) 
    {
        $loginWasSuccessful = Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),

        ]);

        if ($loginWasSuccessful) {
            return redirect()->route('profile.index');
        }
        else {
            return redirect()->route('auth.loginform')->with('error', 'Invalid credentials');
        }

    }
    
    
    public function logout() 
    {
        Auth::logout();
        return redirect()->route('invoice.index');
    }


    public function admin() 
    {
        $config = Configurations::where('name', '=', 'maintenance-mode')->first(); 

        return view('auth.admin', [
            'config' => $config,
        ]);
    }


    public function update(Request $request) 
    {
        $config = Configurations::where('name', '=', 'maintenance-mode')->first(); 
        $config->value = $request->input('maint');
        $config->save();

        return redirect()->route('auth.admin');

    }

    public function maintenance() 
    {
        return view('auth.maintenance');
    }


}
