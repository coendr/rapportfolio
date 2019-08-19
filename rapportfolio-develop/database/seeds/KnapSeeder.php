<?php

use Illuminate\Database\Seeder;

class KnapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('knap')->delete();
        DB::table('knap')->insert(array(
            array('knapid' => 1, 'naam' => 'Ik ben trots op mezelf', 'categorie' => 'zelfknap', 'jaar' => 3),
            array('knapid' => 2, 'naam' => 'Ik ga met plezier naar school', 'categorie' => 'zelfknap', 'jaar' => 3),
            array('knapid' => 3, 'naam' => 'Ik luister naar de juf/meester', 'categorie' => 'zelfknap', 'jaar' => 3),
            array('knapid' => 4, 'naam' => 'Ik ben beleefd en spreek op een normale toon', 'categorie' => 'zelfknap', 'jaar' => 3),
            array('knapid' => 5, 'naam' => 'Ik los een conflict op door te praten', 'categorie' => 'mensknap', 'jaar' => 3),
            array('knapid' => 6, 'naam' => 'Ik kan goed samenwerken', 'categorie' => 'mensknap', 'jaar' => 3),
            array('knapid' => 7, 'naam' => 'Ik kan goed samen spelen', 'categorie' => 'mensknap', 'jaar' => 3),
            array('knapid' => 8, 'naam' => 'Ik geef opstekers', 'categorie' => 'mensknap', 'jaar' => 3),
            array('knapid' => 9, 'naam' => 'Ik heb mijn werk op tijd af', 'categorie' => 'werkknap', 'jaar' => 3),
            array('knapid' => 10, 'naam' => 'Ik kan zelfstandig werken', 'categorie' => 'werkknap', 'jaar' => 3),
            array('knapid' => 11, 'naam' => 'Ik let op tijdens de instructie', 'categorie' => 'werkknap', 'jaar' => 3),
            array('knapid' => 12, 'naam' => 'Ik heb een positieve werkhouding, ook als ik iets minder leuk vind', 'categorie' => 'werkknap', 'jaar' => 3),
        ));
    }
}