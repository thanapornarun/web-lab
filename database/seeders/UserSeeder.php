<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Playlist;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->has(Playlist::factory())
            ->create();

            // User::factory(5)
            // ->hasProfile(1)
            // ->hasEvents(2)
            // ->create()
            // ->each(function ($user) {
            //     $user->events->each(function ($event) {
            //         $event->budgets()->saveMany(
            //             Budget::factory(1)->create([
            //                 'event_id' => $event->id,
            //             ])
            //                 ->each(function ($budget) {
            //                     $budget->expenses()->saveMany(Expense::factory(5)->create([
            //                         'budget_id' => $budget->id, 
            //                     ]));
            //                 })
            //         );
            //     });
            // });
    }
}
