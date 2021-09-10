<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'fund' => 500.0,
            ]
        ]);

        User::factory(10)->create();
    }
}
