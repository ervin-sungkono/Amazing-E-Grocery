<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\Gender;
use App\Models\User;
use App\Models\Item;

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
        Role::create([
            'role_id' => 1,
            'role_name' => 'User'
        ]);
        Role::create([
            'role_id' => 2,
            'role_name' => 'Admin'
        ]);

        Gender::create([
            'gender_id' => 1,
            'gender_desc' => 'Male'
        ]);
        Gender::create([
            'gender_id' => 2,
            'gender_desc' => 'Female'
        ]);

        Item::factory(30)->create();
        User::factory(5)->create([
            'role_id' => 2
        ]);
        User::factory(10)->create();
        User::factory(1)->create([
            'first_name' => 'Ervin',
            'last_name' => 'Sungkono',
            'email' => 'ervinsung@gmail.com'
        ]);
        User::factory(1)->create([
            'first_name' => 'Ervin',
            'last_name' => 'Cahyadinata',
            'email' => 'ervinsung@yahoo.com',
            'role_id' => 2
        ]);
    }
}
