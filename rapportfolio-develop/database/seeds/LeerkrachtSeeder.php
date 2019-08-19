<?php

use Illuminate\Database\Seeder;

class LeerkrachtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leerkracht')->delete();
        DB::table('leerkracht')->insert(
            ['leerkrachtid' => 1, 'userid' => 4, 'voornaam'=>'Marco','tussenvoegsel'=>'de','achternaam'=>'Leeuw', 'groepid'=> '1']
        );
    }
}
