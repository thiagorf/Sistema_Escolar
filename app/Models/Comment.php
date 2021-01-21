<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //Comment
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'comment'
    ];

    public function contents()
    {
        return $this->belongsToMany('App\Models\Content', 'comment_content', 'comment_id', 'content_id',)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
