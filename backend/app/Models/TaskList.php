<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    protected $fillable = ['user_id','title','status'];
    protected $primaryKey = 'id'; 

    public function index(){
        return auth()
        ->user()
        ->TaskList
        ->sortBy("status");
    }

    public function create($fields)
    {
 
        return parent::create([
            'title' => $fields['title'],
            'user_id' => 1,
            'status' => 0,
            
        ]);
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', Auth::id());
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
        return $this->hasMany(\App\Models\Tasks::class,'list_id', 'id');
    }
}