<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Authenticate extends Controller
{
    public function show(Request $request)
    {
        $input = $request->only(['email', 'password']);
        if(Auth::attempt($input, $request->remenber)){
            $courses = Course::all();
            return redirect()->route('content', ['courses' => $courses]);
        }
        return redirect()->back();

    }

    public function register_form()
    {
        return view('students.student_form');
    }

    public function register(Request $request)
    {
        $input = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $user = new User;
        $user->name = $input['name'];
        $user->email =  $input['email'];
        $user->password = Hash::make($input['password']);
        $user->save();
        
        $user->roles()->attach(Role::where('role', 'Aluno')->get('id'));
        
        Auth::login($user);

        
        return redirect()->route('content');
    }

    public function main()
    {
        if(request()->has('sort')) {
            $courses = Course::orderBy('id', request()->query('sort'))->get();
            return response()->view('courses.course_sort' , ['courses' => $courses]);
        };
        $courses = Course::with('users', 'evaluation')->get();
        
        return view('contents.content', ['courses' => $courses]);
    }

    
    public function logout()
    {
        if(auth()->user()){
            Auth::logout();
        }
        return redirect()->route('/');
    }
    
    public function edit(Request $request)
    {
        
        $input = $request->all();
        $user = User::find(auth()->user()->id);
        $user->name = $input['name'];
        $user->email = $input['email'];
        if($request->filled('password')){
            $user->password = Hash::make($input['password']);
        }else {
            $user->password = $user->password;
        }
        
        $user->save();
        return redirect()->route('content');
    }
}
