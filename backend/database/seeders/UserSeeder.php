<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = DB::table('users')->insertGetId([
            'name'      => 'Usuário de Seed',
            'email'     => 'teste@teste.com',
            'password'  => '$2y$10$xMD9DsNkvTE6i8KdG8quge/Qk3K2EfMZQIQYcaa.LyFS8pp2tNHfq',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
