<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Course as C;
use App\Models\Score;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class Course extends Controller
{
    public function show()
    {
        $type = Evaluation::all();
        return view('courses.create_course', ['types' => $type]);
    }

    public function create(Request $request)
    {

        if(!(auth()->user()->roles->first()->role == 'Aluno')){
            $input = $request->validate([
                'name' => 'required',
                'student_number' => 'required',
                'types' => 'required',
                'description' => 'required'
        
            ]);
            $course= new C;
            $course->name = $input['name'];
            $course->description = $input['description'];
            $course->student_number = $input['student_number'];
            $course->evaluation_id = $input['types'];
            $course->save();
            $course->users()->attach(auth()->user()->id);

            return redirect()->route('content');
        }else {
            return back()->withInput();
        }
        
    }

    public function edit_form($id)
    {
        $course = C::find($id);
        $evaluation = Evaluation::all();
        
        return view('courses.course_edit', ['courses' => $course, 'evaluations' => $evaluation]);
    }

    public function edit(Request $request)
    {
        $input = $request->validate([
            'name' => 'required', 
            'student_number' => 'required', 
            'types' => 'required', 
            'description' => 'required', 
        ]);

        $course = C::find($request['id']);
        $course->name = $input['name'];
        $course->student_number = $input['student_number'];
        $course->evaluation_id = $input['types'];
        $course->description = $input['description'];
        $course->save();
       
        return redirect()->route('content');
    }

    public function delete($id)
    {
        $course = C::find($id)->delete();
        return redirect()->route('content');
    }

    public function enter($id)
    {
        $course = C::find($id);
        $course->users()->attach(auth()->user()->id);
        
        return redirect()->route('content');
    }

    // public function showStudents($id)
    // {
    //     $curso = C::find($id);
        
    //     return view('cursos.alunos_curso', ['cursos' => $curso]);
    // }

    public function showContent($id)
    {
        $course = C::find($id);
       
        return view('courses.course_contents', ['course' => $course, 'title' => $course->name]);
    }

    public function leaveCourse($id)
    {
        $course = C::with('scores')->find($id);
        $student = User::with('scores')->find(auth()->user()->id);
        foreach ($student->scores as $scores) {
            foreach ($course->scores as $courseScore) {
                if ($scores->id == $courseScore->id) {
                    $score = Score::find($scores->id);
                    $score->delete();
                }
            }
        } 
        $student->courses()->detach($id);
        
        return redirect()->route('content');
    }
}
