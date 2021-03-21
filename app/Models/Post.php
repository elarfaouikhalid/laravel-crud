<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable=["title","content"];


    // public static function boot()
    // {
        
    //     static::deleting(function(Post $post){
    //         $post->delete();
    //     });

    //     static::restoring(function(Post $post){
    //         $post->comments()->onlyTrashed()->restore();
    //     });
    // }
}
