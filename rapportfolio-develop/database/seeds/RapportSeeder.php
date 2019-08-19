<?php

use Illuminate\Database\Seeder;

class RapportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rapport')->delete();
        DB::table('rapport')->insert(array(
            array('rapportid' => 1, 'naam' => 'rapport 1', 'leerlingid' => 1, 'groepid' => 1, 'jaar' => '2017-2018', 'ouder_bekeken' => '0', 'leerling_bekeken' => '0'),
            array('rapportid' => 2, 'naam' => 'rapport 1', 'leerlingid' => 2, 'groepid' => 1, 'jaar' => '2017-2018', 'ouder_bekeken' => '0', 'leerling_bekeken' => '0'),
            array('rapportid' => 3, 'naam' => 'rapport 1', 'leerlingid' => 3, 'groepid' => 1, 'jaar' => '2017-2018', 'ouder_bekeken' => '0', 'leerling_bekeken' => '0'),
            array('rapportid' => 4, 'naam' => 'rapport 2', 'leerlingid' => 1, 'groepid' => 1, 'jaar' => '2017-2018', 'ouder_bekeken' => '0', 'leerling_bekeken' => '0'),
            array('rapportid' => 5, 'naam' => 'rapport 2', 'leerlingid' => 2, 'groepid' => 1, 'jaar' => '2017-2018', 'ouder_bekeken' => '0', 'leerling_bekeken' => '0'),
            array('rapportid' => 6, 'naam' => 'rapport 2', 'leerlingid' => 3, 'groepid' => 1, 'jaar' => '2017-2018', 'ouder_bekeken' => '0', 'leerling_bekeken' => '0'),
        ));
    }
}
