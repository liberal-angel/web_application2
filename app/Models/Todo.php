<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = ['task','tag_id','user_id'];

    public function user(){
        return $this->hasMany('App\Models\Tag','App\Models\user');
    }
}
