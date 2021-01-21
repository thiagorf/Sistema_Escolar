<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //Content
    use HasFactory;

    protected $table = 'contents';

    protected $fillable = [
        'title', 'body'
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function comments()
    {
        return $this->belongsToMany('App\Models\Comment', 'comment_content', 'content_id', 'comment_id' )->withTimestamps();
    }

    public function files()
    {
        return $this->belongsToMany('App\Models\File', 'content_file', 'content_id', 'file_id')->withTimestamps();
    }
}
