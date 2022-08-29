<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Project;
use App\Models\User;
use App\Models\Phase;
use App\Models\Task;
use App\Models\Team;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


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

        DB::table('sub_tasks')->truncate();
        DB::table('tasks')->truncate();
        DB::table('phases')->truncate();
        DB::table('projects')->truncate();
        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
            "name" => "ofa",
            "email" => "ofa@ofa.com",
            "password" => Hash::make("password") ,

        ]);
        User::create([
            "name" => "jweda",
            "email" => "jweda@jweda.com",
            "password" => Hash::make("password") ,

        ]);


        Project::create([
            "name" => "First Project",
            "description" => "My first Project Discription",
            "due_date" => "1986-09-21 22:42:05",
            "user_id" => 1,
        ]);
        Project::create([
            "name" => "Seconde Project",
            "description" => "My Seconde Project Discription",
            "due_date" => "1986-09-21 22:42:05",
            "user_id" => 1
        ]);
        Project::create([
            "name" => "Third Project",
            "description" => "My Third Project Discription",
            "due_date" => "1986-09-21 22:42:05",
            "user_id" => 1
        ]);

        Phase::create([
            "name" => "first Phase",
            "description" => "My First Phase Discription",
            "due_date" => "1986-09-21 22:42:05",
            "project_id" => 1,
        ]);
        Phase::create([
            "name" => "Seconde Phase",
            "description" => "My Seconde Phase Discription",
            "due_date" => "1986-09-21 22:42:05",
            "project_id" => 1,
        ]);
        Phase::create([
            "name" => "Third Phase",
            "description" => "My Third Phase Discription",
            "due_date" => "1986-09-21 22:42:05",
            "project_id" => 1,
        ]);
        Phase::create([
            "name" => "Forth Phase",
            "description" => "My Forth Phase Discription",
            "due_date" => "1986-09-21 22:42:05",
            "project_id" => 1,
        ]);


        
        Task::create([
            "name" => "first Task",
            "description" => "My First Task Discription",
            "due_date" => "1986-09-21 22:42:05",
            "user_id" => 1,
            "project_id" => 1,
            "phase_id" => 1,
        ]);
        Task::create([
            "name" => "Seconde Task",
            "description" => "My Seconde Task Discription",
            "due_date" => "1986-09-21 22:42:05",
            "user_id" => 1,
            "project_id" => 1,
            "phase_id" => 1,
        ]);
        Task::create([
            "name" => "third Task",
            "description" => "My Third Task Discription",
            "due_date" => "1986-09-21 22:42:05",
            "user_id" => 1,
            "project_id" => 1,
            "phase_id" => 1,
        ]);
        Team::create([
            "name" => "A team",

            "project_id" => 1,

        ]);
        Team::create([
            "name" => "Aer team",

            "project_id" => 1,

        ]);
        // \App\Models\User::factory(10)->create();
    }
}
