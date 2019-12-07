<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'user responsible for administering the platform from the administrator side',
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
            'description' => 'user with basic permissions to read and create invoices',
        ]);
    }
}
