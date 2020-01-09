<?php

use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sellers')->insert([
            'name' => "Danilo",
            'surname' => "Otalvaro",
            'type_Document' => 'CC',
            'document' => '1211203',
            'state' => true,
        ]);
        DB::table('sellers')->insert([
            'name' => "Sara",
            'surname' => "Lopez",
            'type_Document' => 'NIT',
            'document' => '12012812',
            'state' => false,
        ]);
        DB::table('sellers')->insert([
            'name' => "Camila",
            'surname' => "Villada",
            'type_Document' => 'CC',
            'document' => '3123203',
            'state' => true,
        ]);
        DB::table('sellers')->insert([
            'name' => "Cristina",
            'surname' => "Lopez",
            'type_Document' => 'NIT',
            'document' => '2222222',
            'state' => false,
        ]);
    }
}
