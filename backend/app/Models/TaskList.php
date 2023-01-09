<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
      }
      public function tasks(){
        return $this->hasMany('App\Models\Tasks', 'user_id', 'user_id',     
        'list_id', 'id');
      }
}
