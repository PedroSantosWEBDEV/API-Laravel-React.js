<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use Carbon\Carbon;

class TaskListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $table->increments('id');
        //     $table->unsignedInteger('user_id');
        //     $table->foreign('user_id')->references('id')->on('users');
        //     $table->string('title');
        //     $table->string('status');
        //     $table->timestamps();

        $TaskList = DB::table('task_lists')->insertGetId([
            'user_id' => 1,
            'title' => 'Fake',
            'status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
