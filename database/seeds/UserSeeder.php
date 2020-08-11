<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=User::create([
            'username'=>'admin@mail.com',
            'email'=>'admin@mail.com',
            'password'=>bcrypt('12345678'),
        ]);
        $admin->assignRole('Admin');
    }
}
