<?php

use Illuminate\Database\Seeder;

class OuderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ouder')->delete();
        DB::table('ouder')->insert(
            ['ouderid' => 1, 'userid' => 5, 'voornaam'=>'ouder','tussenvoegsel'=>'de','achternaam'=>'ouder']
        );
    }
}
