<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Bancolombia",
            'surname' => "Placetopay",
            'email' => 'admin@gmail.com',
            'type_Document' => "NIT",
            'document' => "936402033",
            'password' => bcrypt('admin123'),
            'role_id' => 1,
            'state' => true,

        ]);
        DB::table('users')->insert([
            'name' => "daniel",
            'surname' => "camilo",
            'email' => 'user@gmail.com',
            'type_Document' => 'CC',
            'document' => '1036343123',
            'password' => bcrypt('user123'),
            'role_id' => 2,
            'state' => true,
        ]);
    }
}
