<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        collect([
            [
                'name' => 'Visitor',
                'email' => 'visitor@mail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Author',
                'email' => 'author@mail.com',
                'password' => bcrypt('password'),
            ],
        ])->each(function ($data) {
            User::create($data);
        });
    }
}
