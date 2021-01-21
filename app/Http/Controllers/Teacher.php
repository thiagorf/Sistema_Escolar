<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Teacher extends Controller
{
    //cadastrar
    public function register(Request $request)
    {
        if (auth()->user()->roles->first()->role == 'Admin') {
            $input = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

            $user = new User;
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->password = Hash::make($input['password']);
            $user->save();
            $user->roles()->attach(Role::where('role', 'Professor')->get('id'));
        }
        

        return redirect()->route('content');
    }
}
