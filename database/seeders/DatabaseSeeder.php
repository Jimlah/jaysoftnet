<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->admin()->create([
            'username' => 'admin',
            'password' => 'pass'
        ]);

        User::factory(5)->admin()->create();

        User::factory(10)->create()->each(function ($user) {
            $user->tickets()->saveMany(Ticket::factory(rand(1, 5))->make());

            $user->tickets()->saveMany(Ticket::factory(rand(1, 5))->open()->make());
        });

        User::find(9)->update([
            'username' => 'user',
            'password' => 'pass'
        ]);
    }
}
