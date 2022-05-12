<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
     public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {   
        //validate form
        $this->validate($request, [
            'name' => 'required|max:225',
            'username' => 'required|max:225',
            'email' => 'required|email|max:225',
            'password' => 'required|confirmed',
        ]);

        
        //store user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        
        //sign in the user

        //Auth::attempt  //facade  or

        //auth()->attempt(['email' => $email, 'password' => $password]);

        auth()->attempt($request->only('email', 'password'));
        //redirect
        return redirect()->route('dashboard');
    }
}
