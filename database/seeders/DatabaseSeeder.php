<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\TourPlace;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

use Database\Factories\BusinessUserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    use HasFactory;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin',]);
        Role::create(['name' => 'pengunjung',]);
        Role::create(['name' => 'pengelola',]);

        User::factory()->create([
            'name' => 'Administrator',
            'username' => Str::slug('Administrator'),
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Ilmi Faizan',
            'username' => Str::slug('Ilmi Faizan'),
            'email' => 'ilmifaizan1112@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'Imam Saputra',
            'username' => Str::slug('Imam Saputra'),
            'email' => 'imam@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
            'tour_place_id' => 1,
        ]);

        User::factory(47)->create();
        // TourPlace::factory(5)->create();
    }
}
