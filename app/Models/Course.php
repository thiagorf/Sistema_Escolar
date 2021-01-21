<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //Course
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'name', 'student_number', 'evaluation_id', 'description' 
    ];
    // protected $touches = ['avaliacao'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'course_user', 'course_id', 'user_id')->withTimestamps();
    }
    
    public function evaluation()
    {
        return $this->belongsTo('App\Models\Evaluation', 'evaluation_id');
    }

    public function contents()
    {
        return $this->hasMany('App\Models\Content', 'course_id');
    }    

    public function scores()
    {
        return $this->belongsToMany('App\Models\Score', 'course_score', 'course_id', 'score_id')->withTimestamps();
    }
}
