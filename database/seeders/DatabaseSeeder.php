<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Message;
use App\Models\Project;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();
        DB::table('messages')->truncate();
        DB::table('projects')->truncate();


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        User::create([
            "name" => "jweda",
            "email" => "jweda@jweda.com",
            "password" => Hash::make("password"),
        ]);
        User::create([
            "name" => "jweda",
            "email" => "jweda2@jweda.com",
            "password" => Hash::make("password"),
        ]);
        User::create([
            "name" => "jweda",
            "email" => "jweda3@jweda.com",
            "password" => Hash::make("password"),
        ]);

        Project::create([
            "name" => "test project",
            "user_id"=>1
        ]);
        Message::create([
            "message" => "hello",
            "user_id" => 1,
            "receiver_id" =>2,
        ]);
        Message::create([
            "message" => "hello2",
            "user_id" => 2,
            "receiver_id" =>1,
        ]);
        Message::create([
            "message" => "hello3",
            "user_id" => 1,
            "receiver_id" =>2,
        ]);
        Message::create([
            "message" => "hello",
            "user_id" => 1,
            "receiver_id" =>3,
        ]);
        

        // \App\Models\User::factory(10)->create();
    }
}
