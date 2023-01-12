<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TaskList extends Model
{
    protected $fillable = ['user_id','title','status'];

    public function index(){
        return auth()
        ->user()
        ->TaskList
        ->sortBy("status");
    }

    public function create($fields)
    {
        // $user = '';
        $tasklist = parent::create([
            'title' => $fields['title'],
            'user_id' => 1,
            'status' => 0 
        ]);
        return $tasklist;
    }

    public function show($id)
    {
        $show = TaskList::find($id);
 
        if (!$show) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $show;
    }

    public function updateList($fields, $id)
    {
        $tasklist = $this->show($id);

        $tasklist->update($fields);
        return $tasklist;
    }

    public function destroyList($id)
    {
        $tasklist = $this->show($id);

        $tasklist->delete();
        return $tasklist;
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function tasks(){
        return $this->hasMany('App\Models\Tasks');
    }
}