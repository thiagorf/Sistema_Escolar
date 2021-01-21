<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation', 'score'
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimeStamps();
    }

    public function file()
    {
        return $this->belongsTo('App\Models\File');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'course_score', 'score_id', 'course_id')->withTimestamps();
    }
}

