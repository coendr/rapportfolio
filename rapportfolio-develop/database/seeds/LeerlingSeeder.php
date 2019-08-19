<?php

use Illuminate\Database\Seeder;

class LeerlingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        DB::table('leerling')->delete();
        DB::table('leerling')->insert(array(
            array('leerlingid'=>'1','userid'=>'1','voornaam'=>'tyciano','tussenvoegsel'=>'','achternaam'=>'leider','groepid'=>'1','start_datum' => '2018-02-02', 'eind_datum' => '2050-02-02'),
            array('leerlingid'=>'2','userid'=>'2','voornaam'=>'coen','tussenvoegsel'=>'de','achternaam'=>'rijter','groepid'=>'1','start_datum' => '2018-02-02', 'eind_datum' => '2050-02-02'),
            array('leerlingid'=>'3','userid'=>'3','voornaam'=>'dennis','tussenvoegsel'=>'','achternaam'=>'tsibidakis','groepid'=>'1','start_datum' => '2018-02-02', 'eind_datum' => '2050-02-02'),

        ));
    }
}
