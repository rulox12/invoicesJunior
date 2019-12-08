<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => "Estefania",
            'surname' => "Guerrero",
            'type_Document' => 'CC',
            'document' => '102222203',
            'state' => true,
        ]);
        DB::table('customers')->insert([
            'name' => "Cristina",
            'surname' => "Lopez",
            'type_Document' => 'CC',
            'document' => '29273912',
            'state' => false,
        ]);
    }
}
