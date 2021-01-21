<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content as Material;
use App\Models\Course;
use App\Models\User;
use App\Models\File;
use App\Models\Score;
use Illuminate\Support\Facades\Storage;

class Content extends Controller
{
    public function show($id)
    {
        $course = Course::find($id);
       
        return view('contents.content_create', ['course' => $course]);
    }

    public function create(Request $request)
    {
       
        $input = $request->validate([
            'title' => 'required|min:8',
            'body' => 'required',
            'file' => 'nullable'
        ]);
        
        
        $content = new Material;
        $content->title = $input['title'];
        $content->body = $input['body'];   
        $content->course()->associate($request['id']);
        $content->save();

        if($request->has('file')) {
            $file = $request->file('file');

            $path = new File;
            $path->fileName = $file->getClientOriginalName();
            $path->path = $file->store('Material');
            $path->user()->associate(auth()->user()->id);
            $path->save();
            $path->contents()->attach($content->id);
            
        }
 
        return redirect()->route('content');
    }

    public function formEdit($id)
    {
        $content = Material::find($id);
        return view('contents.content_edit', ['content' => $content]);
    }

    public function delete($id)
    {
        $content = Material::find($id)->delete();
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        
        $input = $request->validate([
            'title' => 'required',
            'body' => 'required',
            
        ]);
        
        $content = Material::find($request['id']);
        $content->title = $input['title'];
        $content->body = $input['body'];
        $content->save();

        if ($request->has('file')) {
            $fileP = $request->file('file');
            $file = new File;
            $file->path =  $fileP->store('Material');
            $file->fileName =  $fileP->getClientOriginalName();
            $file->user()->associate(auth()->user()->id);
            $file->save();
            $file->contents()->attach($content->id);    
        } else {
            $content->files()->detach();/////////////////////////////////////////////
            $files = File::with('contents')->latest()->first();
            if ($files->contents->isEmpty()) {
                $files->user()->dissociate();
                $files->delete();
            }else {
                dd($content);
            }
              
        }
        
        return redirect()->back();
    }

    public function specificContent($id)
    {
        
        $content = Material::with('comments', 'course', 'files')->find($id); 
        return view('contents.specific_content', ['content' => $content]);
    }

    public function pdfShow($id)
    {
        $file = File::find($id);
        return response()->file("storage/" . $file->path);
        
    }

    public function studentPDF(Request $request)
    {
        
        $file = new File;
        $file->fileName = $request->file('file')->getClientOriginalName();
        $file->path = $request->file('file')->store('Material');
        $file->user()->associate(auth()->user()->id);
        $file->save();
        $file->contents()->attach($request['id']);
        
        return response()->json(['success' => 'Deu certo']);
    }

    public function evaluate_form($id, $f_id)
    {
        $student = User::find($id);
        $file = File::find($f_id);
        return view('contents.content_evaluation', ['student' => $student, 'files' => $file]);
    }

    public function evaluate(Request $request)
    {
        $input = $request->all();

        $score = new Score;
        $score->evaluation = $request['evaluation'];
        $score->score = $request['score'];
        $score->file()->associate($request['id']);
        $score->save();
        $score->users()->attach($request['student_id']);
        $score->courses()->attach($request['course_id']);
        
        return redirect()->back();
    }

    public function scoreShow() 
    {
       
        if((auth()->user()->roles->first()->role == 'Aluno')) {
            $sc = User::find(auth()->user()->id);
            
        }else {
            $sc = User::with('courses')->find(auth()->user()->id);
            
        }
        

        return view('contents.scores', ['user' => $sc]);
    }

    public function scoreEdit($id)
    {
        $score = Score::find($id);

        return view('contents.scoreEdit', ['score' => $score]);
    }
    
    public function scoreUpdate(Request $request)
    {
        $input = $request->all();
        $score = Score::find($input['id']);
        $score->evaluation = $input['evaluation'];
        $score->score = $input['score'];
        $score->save();

        return redirect()->route('scores');
    }
}
