<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'firstname' => 'admin',
                'email' => 'admin@admin.fr',
                'password' => Hash::make("admin"),
                'is_admin' => true,
                'address' => '10 rue de Paris, 75003, Paris',
                'country' => 'France',
            ],
            [
                'firstname' => 'client1',
                'email' => 'client1@bitchest.fr',
                'password' => Hash::make("client1"),
                'is_admin' => true,
                'address' => '1 Boulevard Gallieni, 75008, Paris',
                'country' => 'France',
            ]
        ]);

        User::factory(10)->create();
    }
}
