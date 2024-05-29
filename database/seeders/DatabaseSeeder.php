<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Bouncer::role()->firstOrCreate(['name' => 'admin']);
        $managerRole = Bouncer::role()->firstOrCreate(['name' => 'manager']);
        $userRole = Bouncer::role()->firstOrCreate(['name' => 'user']);
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

//        // Definisanje uloge 'admin'
//        Bouncer::role()->create([
//            'name' => 'admin',
//            'title' => 'Admin',
//        ]);

//        // Definisanje uloge 'admin'
//        Bouncer::role()->create([
//            'name' => 'manager',
//            'title' => 'Manager',
//        ]);
//
//        // Definisanje uloge 'admin'
//        Bouncer::role()->create([
//            'name' => 'user',
//            'title' => 'User',
//        ]);
//
//        // Kreiranje admina
//        $admin = User::create([
//            'name' => 'Admin',
//            'email' => 'admin@example.com',
//            'password' => Hash::make('password'),
//        ]);
//
//        // Dodela uloge 'admin' korisniku
//        Bouncer::assign('admin')->to($admin);

//
//        $manager01 = User::create([
//            'name' => 'manager01',
//            'email' => 'manager01@example.com',
//            'password' => Hash::make('password'),
//        ]);
//
//        // Dodela uloge 'admin' korisniku
//        Bouncer::assign('manager')->to($manager01);


//        $user01 = User::create([
//            'name' => 'User',
//            'email' => 'user@example.com',
//            'password' => Hash::make('password'),
//        ]);
//
//        Bouncer::assign('user')->to($user01);

//        $admin02 = User::create([
//            'name' => 'Admin02',
//            'email' => 'admin02@example.com',
//            'password' => Hash::make('password'),
//        ]);
//
//        // Dodela uloge 'admin' korisniku
//        Bouncer::assign('admin')->to($admin02);

        // Definišemo dozvolu za ažuriranje korisnika
        Bouncer::allow('admin')->to(['edit-users', 'update-users', 'delete-users', 'create-managers', 'create-categories', 'manage-categories']);
//        Bouncer::allow('manager')->to(['create-categories']);
    }

    // admin 1
    // manager 2
    // user 3

}
