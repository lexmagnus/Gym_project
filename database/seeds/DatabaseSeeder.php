<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'lexmagnux',
            'email' => 'lexmagnus1088@gmail.com',
            'password' => bcrypt('968826819'),
            'status' => '1'
        ]);
    }
}
