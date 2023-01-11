<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->insertGetId([
                'name'      => 'Admin',
                'email'     => 'teste@teste.com',
                'password'  => '$2y$10$xMD9DsNkvTE6i8KdG8quge/Qk3K2EfMZQIQYcaa.LyFS8pp2tNHfq',
                'remember_token' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $TaskList = DB::table('task_lists')->insertGetId([
                'user_id' => $user,
                'title' => 'Fake',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $Task = DB::table('tasks')->insertGetId([
                        'user_id' => $user,
                        'list_id'=> $TaskList,
                        'title' => 'Fake',
                        'status' => 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
    }
}
