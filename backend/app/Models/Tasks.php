<?php

namespace App\Models;

use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tasks extends Model
{
    
    protected $fillable = ['list_id', 'user_id','title','status'];

    public function index(){
        // $tasks = DB::table('tasks')->get();
        return auth()
            ->user()
            ->Tasks;
    }

    public function store($fields)
    {
        $list = auth()
        ->user()
        ->tasklist()->find($fields['list_id']);
     
        if (!$list) {
            throw new \Exception('Lista não Encontrada', -404);
        }

        if ($list['user_id'] !== auth()->user()->id) {
            throw new \Exception('Esta Lista não pertence a este Usuário.', -403);
        }

        $list->update(['status' => 0]);

        return $list->tasks()->create($fields); 
    }

    public function show($id){
        $show = auth()
        ->user()
        ->tasks()
        ->find($id);
 
        if (!$show) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $show;
    }

    public function tasksByList($listId){
        $tasks = DB::table('tasks')->where('list_id', '=', $listId)->get();

        return $tasks;
    }

    public function closeTask($id){
        $task = $this->show($id);
        $task->update(['status' => 1]);
        
        $list = Auth()
        ->user()
        ->tasklist()->find($task['list_id']);

        $taskOpen = Auth()
        ->user()
        ->tasks()
        ->where('list_id', '=', $task['list_id'])
        ->where('status', 0)
        ->get();
        
        if(count($taskOpen) === 0){
            $list->update(['status' => 1]);
        }
        return $task;
    }

    public function updateTask($fields, $id)
    {
        $task = $this->show($id);

        $task->update($fields);
        return $task;
    }

    public function destroyTask($id)
    {
        $task = $this->show($id);
        $task->delete();

        $list = Auth()
        ->user()
        ->tasklist()->find($task['list_id']);

        $taskOpen = Auth()
        ->user()
        ->tasks()
        ->where('list_id', '=', $task['list_id'])
        ->where('status', 0)
        ->get();
        
        if(count($taskOpen) === 0){
            $list->update(['status' => 1]);
        }

        return $task;
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
    public function tasklist()
    {
        return $this->belongsToMany(\App\Models\Tasks::class, 'tasks', 'list_id', 'id');
        // return $this->hasMany(\App\Models\Tasks::class,'list_id', 'id');
        // return $this->belongsTo('App\Tasks', 'list_id', 'id');
    }
}