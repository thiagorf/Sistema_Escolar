<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'path', 'fileName'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function contents()
    {
        return $this->belongsToMany('App\Models\Content', 'content_file', 'file_id', 'content_id')->withTimestamps();
    }

    public function scores()
    {
        return $this->hasMany('App\Models\Score')->withTimestamps();
    }
}
