<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Job extends Model
{
    use SoftDeletes;
    protected $table = "job";
    protected $fillable = ['title' , 'budget' , 'description' , 'user_id' , 'skills'];
}
