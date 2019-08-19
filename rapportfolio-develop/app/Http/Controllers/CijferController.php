<?php

namespace App\Http\Controllers;

use App;
use App\Beoordeling;
use App\Rapport;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CijferController extends Controller
{
    public static function CheckVakIngevuld1($vakid)
    {
        if (date("m") < 8) {
            $jaar1 = date("Y") - 1;
            $jaar2 = date("Y");
        } else {

            $jaar1 = date("Y");
            $jaar2 = date("Y") + 1;
        }


        $jaar = $jaar1 . "-" . $jaar2;

        $lid = Auth::user()->id;

        $groepsid = DB::table('leerkracht')
            ->where('userid', '=', $lid)
            ->select('groepid')
            ->first();

        $leerlingid = DB::table('leerling')
            ->where('groepid', '=', $groepsid->groepid)
            ->select('leerlingid')
            ->first();

        $rapportid = DB::table('rapport')
            ->where('leerlingid', '=', $leerlingid->leerlingid)
            ->where('naam', '=', "rapport 1")
            ->where('jaar', '=', $jaar)
            ->select('rapportid')
            ->first();
        if ($rapportid == null) {
            return 0;
        } else {
            $beoordeling = DB::table('beoordeling')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->where('vakid', '=', $vakid)
                ->select('cijfer')
                ->first();
        }


        if (isset($beoordeling)) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function CheckVakIngevuld2($vakid)
    {
        if (date("m") < 8) {
            $jaar1 = date("Y") - 1;
            $jaar2 = date("Y");
        } else {

            $jaar1 = date("Y");
            $jaar2 = date("Y") + 1;
        }


        $jaar = $jaar1 . "-" . $jaar2;

        $lid = Auth::user()->id;

        $groepsid = DB::table('leerkracht')
            ->where('userid', '=', $lid)
            ->select('groepid')
            ->first();

        $leerlingid = DB::table('leerling')
            ->where('groepid', '=', $groepsid->groepid)
            ->select('leerlingid')
            ->first();

        $rapportid = DB::table('rapport')
            ->where('leerlingid', '=', $leerlingid->leerlingid)
            ->where('naam', '=', "rapport 2")
            ->where('jaar', '=', $jaar)
            ->select('rapportid')
            ->first();
        if ($rapportid == null) {
            return 0;
        } else {
            $beoordeling = DB::table('beoordeling')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->where('vakid', '=', $vakid)
                ->select('cijfer')
                ->first();
        }


        if (isset($beoordeling)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function Schooljaar()
    {
        if (date("m") < 8) {
            $jaar1 = date("Y") - 1;
            $jaar2 = date("Y");
        } else {
            $jaar1 = date("Y");
            $jaar2 = date("Y") + 1;
        }
        $schooljaar = $jaar1 . "-" . $jaar2;

        return $schooljaar;
    }

    public function ShowInvullen()
    {
        if (Auth::user()->hasRole('leerkracht')) {
            $leerlingid = $_POST['leerlingid'];
            $rapport = $_POST['rapport'];
            return view('rapport/invullen');
        } elseif (Auth::user()->hasRole('leerling')) {
            return view('rapport/invullen');
        } else {
            return redirect()->route('home');
        }
    }

    public function GetVakinvul(Request $request)
    {
        $succes = $request->session()->get('succes');

        $leerkrachtid = Auth::user()->id;
        $groepid = DB::table('leerkracht')
            ->where('userid', '=', $leerkrachtid)
            ->select('groepid')
            ->first();

        $groepnaam = DB::table('groep')
            ->where('groepid', '=', $groepid->groepid)
            ->select('groep')
            ->first();

        $vakken = DB::table('vak')
            ->select('naam', 'vakid', 'groep')
            ->get();

        return view('rapport/invullen_kiezen', ['vakken' => $vakken, 'groepid' => $groepid, 'groepnaam' => $groepnaam, 'succes' => $succes]);
    }

    public function GetLeerlingbekijk()
    {

        $leerkrachtid = Auth::user()->id;
        $groepid = DB::table('leerkracht')
            ->where('userid', '=', $leerkrachtid)
            ->select('groepid')
            ->first();

        $leerlingen = DB::table('leerling')
            ->where('groepid', '=', $groepid->groepid)
            ->select('voornaam', 'tussenvoegsel', 'achternaam', 'leerlingid')
            ->orderBy('voornaam')
            ->get();

        return view('rapport/bekijken_kiezen', ['leerlingen' => $leerlingen]);
    }

    public function GetLeerlingWijzig(Request $request)
    {
        $succes = $request->session()->get('succes');

        $leerkrachtid = Auth::user()->id;
        $groepid = DB::table('leerkracht')
            ->where('userid', '=', $leerkrachtid)
            ->select('groepid')
            ->first();

        $leerlingen = DB::table('leerling')
            ->where('groepid', '=', $groepid->groepid)
            ->select('voornaam', 'tussenvoegsel', 'achternaam', 'leerlingid')
            ->orderBy('voornaam')
            ->get();

        return view('rapport/wijzigen_kiezen', ['leerlingen' => $leerlingen, 'succes' => $succes]);
    }

    public function GetJaar($id)
    {
        $jaar = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->select('jaar')
            ->groupBy('jaar')
            ->orderBy('jaar', 'desc')
            ->get();

        return view('rapport/bekijken_jaar', ['id' => $id, 'jaar' => $jaar]);
    }

    public function GetJaarLeerling()
    {
        $jaar = DB::table('rapport')
            ->where('leerlingid', '=', Auth::user()->id)
            ->select('jaar')
            ->groupBy('jaar')
            ->get();

        return view('rapport/bekijken_jaar', ['id' => Auth::user()->id, 'jaar' => $jaar]);
    }

    public function CijferInvullen1($id)
    {
        $lid = Auth::user()->id;

        $groepsid = DB::table('leerkracht')
            ->where('userid', '=', $lid)
            ->select('groepid')
            ->first();

        $leerlingid = DB::table('leerling')
            ->where('groepid', '=', $groepsid->groepid)
            ->select('leerlingid')
            ->first();

        $rapportid = DB::table('rapport')
            ->where('leerlingid', '=', $leerlingid->leerlingid)
            ->where('naam', '=', "rapport 1")
            ->where('jaar', '=', $this->Schooljaar())
            ->select('rapportid')
            ->first();
        if ($rapportid == null) {
            $beoordeling = null;
        } else {

            $beoordeling = DB::table('beoordeling')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->where('vakid', '=', $id)
                ->select('cijfer')
                ->first();
        }

        $vak = DB::table('vak')
            ->where('vakid', '=', $id)
            ->select('naam')
            ->first();


        if (isset($beoordeling)) {
            $error = $vak->naam . " in rapport 1 is al ingevuld";
            return redirect()->back()->with('error', $error);
        } else {
            $leerlingen = DB::table('leerling')
                ->where('groepid', '=', $groepsid->groepid)
                ->select('voornaam', 'tussenvoegsel', 'achternaam', 'leerlingid')
                ->OrderBy('voornaam')
                ->get();

            $cijfer = array('o', 'm', 'v', 'rv', 'g');


            return view('rapport/invullen1', ['leerlingen' => $leerlingen, 'cijfer' => $cijfer, 'id' => $id, 'vak' => $vak]);
        }
    }

    public function CijferInvullen2($id)
    {
        $lid = Auth::user()->id;

        $groepsid = DB::table('leerkracht')
            ->where('userid', '=', $lid)
            ->select('groepid')
            ->first();

        $leerlingid = DB::table('leerling')
            ->where('groepid', '=', $groepsid->groepid)
            ->select('leerlingid')
            ->first();

        $rapportid = DB::table('rapport')
            ->where('leerlingid', '=', $leerlingid->leerlingid)
            ->where('naam', '=', "rapport 2")
            ->where('jaar', '=', $this->Schooljaar())
            ->select('rapportid')
            ->first();
        if ($rapportid == null) {
            $beoordeling = null;
        } else {

            $beoordeling = DB::table('beoordeling')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->where('vakid', '=', $id)
                ->select('cijfer')
                ->first();
        }
        $vak = DB::table('vak')
            ->where('vakid', '=', $id)
            ->select('naam')
            ->first();


        if (isset($beoordeling)) {
            $error = $vak->naam . " in rapport 2 is al ingevuld";
            return redirect()->back()->with('error', $error);
        } else {
            $leerlingen = DB::table('leerling')
                ->where('groepid', '=', $groepsid->groepid)
                ->select('voornaam', 'tussenvoegsel', 'achternaam', 'leerlingid')
                ->OrderBy('voornaam')
                ->get();

            $cijfer = array('o', 'm', 'v', 'rv', 'g');


            return view('rapport/invullen2', ['leerlingen' => $leerlingen, 'cijfer' => $cijfer, 'id' => $id, 'vak' => $vak]);
        }
    }

    public function InsertCijfer1(Request $request, $id)
    {

        //Validatie 
        for ($i = 1; $i <= $request->klascount; $i++) {
            $request->validate(["cijfer.$i" => 'required']);
        }

        $jaar = $this->Schooljaar();

        $lid = Auth::user()->id;
        $groepsid = DB::table('leerkracht')
            ->where('userid', '=', $lid)
            ->select('groepid')
            ->first();
        $leerlingid = DB::table('leerling')
            ->where('groepid', '=', $groepsid->groepid)
            ->select('leerlingid')
            ->first();
        $rapport = DB::table('rapport')
            ->where('leerlingid', '=', $leerlingid->leerlingid)
            ->where('naam', '=', "rapport 1")
            ->where('jaar', '=', $jaar)
            ->select('rapportid')
            ->first();

        if (!isset($rapport)) {
            $allleerlingen = DB::table('leerling')
                ->where('groepid', '=', $groepsid->groepid)
                ->select('leerlingid')
                ->get();


            foreach ($allleerlingen as $a) {
                $newrapport = new Rapport();
                $newrapport->naam = "rapport 1";
                $newrapport->leerlingid = $a->leerlingid;
                $newrapport->groepid = $groepsid->groepid;
                $newrapport->jaar = $jaar;
                $newrapport->notitie = null;
                $newrapport->ouder_bekeken = 0;
                $newrapport->leerling_bekeken = 0;
                $newrapport->timestamps = false;
                $newrapport->save();
            }
        }

        $vaknaam = DB::table('vak')
            ->where('vakid', '=', $id)
            ->select('naam')
            ->first();

        foreach ($request->cijfer as $key => $value) {
            $rap = Rapport::where('leerlingid', $key)->where(['jaar' => $jaar])->where(['naam' => 'rapport 1'])->first();

            $cijfer = new Beoordeling();
            $cijfer->cijfer = $value;
            $cijfer->vakid = $id;
            $cijfer->rapportid = $rap->rapportid;
            $cijfer->timestamps = false;
            $cijfer->save();
        }

        $messeage = $vaknaam->naam . " is ingevuld in rapport 1!";
        return redirect()->route('kiesvak')->with('succes', $messeage);
    }

    public function InsertCijfer2(Request $request, $id)
    {
        for ($i = 1; $i <= $request->klascount; $i++) {
            $request->validate(["cijfer.$i" => 'required']);
        }

        $jaar = $this->Schooljaar();

        $lid = Auth::user()->id;
        $groepsid = DB::table('leerkracht')
            ->where('userid', '=', $lid)
            ->select('groepid')
            ->first();


        $leerlingid = DB::table('leerling')
            ->where('groepid', '=', $groepsid->groepid)
            ->select('leerlingid')
            ->first();

        $rapport = DB::table('rapport')
            ->where('leerlingid', '=', $leerlingid->leerlingid)
            ->where('naam', '=', "rapport 2")
            ->where('jaar', '=', $jaar)
            ->select('rapportid')
            ->first();

        if (!isset($rapport)) {
            $allleerlingen = DB::table('leerling')
                ->where('groepid', '=', $groepsid->groepid)
                ->select('leerlingid')
                ->get();

            foreach ($allleerlingen as $a) {
                $newrapport = new Rapport();
                $newrapport->naam = "rapport 2";
                $newrapport->leerlingid = $a->leerlingid;
                $newrapport->groepid = $groepsid->groepid;
                $newrapport->jaar = $jaar;
                $newrapport->notitie = null;
                $newrapport->ouder_bekeken = 0;
                $newrapport->leerling_bekeken = 0;
                $newrapport->timestamps = false;
                $newrapport->save();
            }
        }

        $vaknaam = DB::table('vak')
            ->where('vakid', '=', $id)
            ->select('naam')
            ->first();

        foreach ($request->cijfer as $key => $value) {
            $rap = Rapport::where('leerlingid', $key)->where(['jaar' => $jaar])->where(['naam' => 'rapport 2'])->first();

            $cijfer = new Beoordeling();
            $cijfer->cijfer = $value;
            $cijfer->vakid = $id;
            $cijfer->rapportid = $rap->rapportid;
            $cijfer->timestamps = false;
            $cijfer->save();
        }

        $messeage = $vaknaam->naam . " is ingevuld in rapport 2!";
        return redirect()->route('kiesvak')->with('succes', $messeage);
    }


    public function Bekijkenrapport($id, $jaar)
    {
        date_default_timezone_set("Europe/Amsterdam");
        setlocale(LC_ALL, 'nl_NL');
        $datum = strftime("%A %d %B %Y") . " om " . strftime("%H:%M");

        if (Auth::user()->hasRole('Admin')) {
            return redirect()->route('home');
        } else {
            $leerling = DB::table('leerling')
                ->where(['leerlingid' => $id])
                ->select('voornaam', 'tussenvoegsel', 'achternaam', 'leerlingid')
                ->first();

            $rid1 = DB::table('rapport')
                ->where(['leerlingid' => $id])
                ->where(['jaar' => $jaar])
                ->where(['naam' => 'rapport 1'])
                ->select('rapportid')
                ->first();

            $rid2 = DB::table('rapport')
                ->where(['leerlingid' => $id])
                ->where(['jaar' => $jaar])
                ->where(['naam' => 'rapport 2'])
                ->select('rapportid')
                ->first();
            if ($rid1 != null) {

                $cijfer1 = DB::table('beoordeling')
                    ->join('vak', 'beoordeling.vakid', '=', 'vak.vakid')
                    ->where('beoordeling.rapportid', '=', $rid1->rapportid)
                    ->select('beoordeling.cijfer', 'vak.naam')
                    ->get();

                $cijfer = DB::table('beoordeling')
                    ->where('rapportid', '=', $rid1->rapportid)
                    ->select('cijfer')
                    ->first();


                $notitie1 = DB::table('rapport')
                    ->where(['leerlingid' => $id])
                    ->where(['jaar' => $jaar])
                    ->where(['naam' => 'rapport 1'])
                    ->select('notitie', 'jaar', 'notitie_leerling')
                    ->first();

                $zelfknap1 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid1->rapportid)
                    ->where('categorie', '=', 'zelfknap')
                    ->select('reflectie.kind', 'reflectie.leerkracht', 'knap.naam')
                    ->get();

                $mensknap1 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid1->rapportid)
                    ->where('categorie', '=', 'mensknap')
                    ->select('reflectie.kind', 'reflectie.leerkracht', 'knap.naam')
                    ->get();;

                $werkknap1 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid1->rapportid)
                    ->where('categorie', '=', 'werkknap')
                    ->select('reflectie.kind', 'reflectie.leerkracht', 'knap.naam')
                    ->get();

                $check1 = DB::table('reflectie')
                    ->where('rapportid', '=', $rid1->rapportid)
                    ->where('knapid', '=', 1)
                    ->select('kind')
                    ->first();

                $check2 = null;
                $leerlingbekeken = DB::table('rapport')
                    ->where('rapportid', '=', $rid1->rapportid)
                    ->select('leerling_bekeken')
                    ->first();

                $ouderbekeken = DB::table('rapport')
                    ->where('rapportid', '=', $rid1->rapportid)
                    ->select('ouder_bekeken')
                    ->first();


                if (Auth::user()->hasrole('ouder')) {

                    DB::table('rapport')
                        ->where('rapportid', '=', $rid1->rapportid)
                        ->update(['ouder_bekeken' => $datum]);

                } elseif (Auth::user()->hasrole('leerling')) {

                    DB::table('rapport')
                        ->where('rapportid', '=', $rid1->rapportid)
                        ->update(['leerling_bekeken' => $datum]);

                }
            }
            if ($rid2 == null) {
                $cijfer2 = null;
                $notitie2 = null;
                $check3 = null;
                return view('rapport/bekijken', ['cijfer' => $cijfer, 'cijfer1' => $cijfer1, 'cijfer2' => $cijfer2, 'leerling' => $leerling, 'notitie1' => $notitie1, 'notitie2' => $notitie2, 'zelfknap1' => $zelfknap1, 'mensknap1' => $mensknap1, 'werkknap1' => $werkknap1, 'check1' => $check1, 'check2' => $check2, 'check3' => $check3, 'leerlingbekeken' => $leerlingbekeken, 'ouderbekeken' => $ouderbekeken]);
            } else {

                $check3 = DB::table('beoordeling')
                    ->where('rapportid', '=', $rid2->rapportid)
                    ->select('cijfer')
                    ->first();

                $notitie2 = DB::table('rapport')
                    ->where(['leerlingid' => $id])
                    ->where(['jaar' => $jaar])
                    ->where(['naam' => 'rapport 2'])
                    ->select('notitie', 'notitie_leerling', 'jaar')
                    ->first();

                $cijfer2 = DB::table('beoordeling')
                    ->join('vak', 'beoordeling.vakid', '=', 'vak.vakid')
                    ->where('beoordeling.rapportid', '=', $rid2->rapportid)
                    ->select('beoordeling.cijfer', 'vak.naam')
                    ->get();

                $check2 = DB::table('reflectie')
                    ->where('rapportid', '=', $rid2->rapportid)
                    ->where('knapid', '=', 1)
                    ->select('kind')
                    ->first();

                $zelfknap2 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid2->rapportid)
                    ->where('categorie', '=', 'zelfknap')
                    ->select('reflectie.kind', 'reflectie.leerkracht', 'knap.naam')
                    ->get();


                $mensknap2 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid2->rapportid)
                    ->where('categorie', '=', 'mensknap')
                    ->select('reflectie.kind', 'reflectie.leerkracht', 'knap.naam')
                    ->get();

                $werkknap2 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid2->rapportid)
                    ->where('categorie', '=', 'werkknap')
                    ->select('reflectie.kind', 'reflectie.leerkracht', 'knap.naam')
                    ->get();

                $ouderbekeken2 = DB::table('rapport')
                    ->where('rapportid', '=', $rid2->rapportid)
                    ->select('ouder_bekeken')
                    ->first();

                $leerlingbekeken2 = DB::table('rapport')
                    ->where('rapportid', '=', $rid2->rapportid)
                    ->select('leerling_bekeken')
                    ->first();

                if (Auth::user()->hasrole('ouder')) {


                    if ($ouderbekeken2->ouder_bekeken == 0) {
                        DB::table('rapport')
                            ->where('rapportid', '=', $rid2->rapportid)
                            ->update(['ouder_bekeken' => $datum]);
                    }
                } elseif (Auth::user()->hasrole('leerling')) {


                    DB::table('rapport')
                        ->where('rapportid', '=', $rid2->rapportid)
                        ->update(['leerling_bekeken' => $datum]);
                }

                if ($rid1 == null) {
                    $cijfer = null;
                    $notitie1 = null;
                    $check1 = null;
                    $ouderbekeken = $ouderbekeken2;
                    $leerlingbekeken = $leerlingbekeken2;
                    return view('rapport/bekijken', ['cijfer' => $cijfer, 'cijfer2' => $cijfer2,
                        'leerling' => $leerling, 'notitie1' => $notitie1, 'notitie2' => $notitie2,
                        'zelfknap2' => $zelfknap2, 'mensknap2' => $mensknap2, 'werkknap2' => $werkknap2,
                        'check1' => $check1, 'check2' => $check2, 'check3' => $check3, 'ouderbekeken' => $ouderbekeken, 'leerlingbekeken' => $leerlingbekeken]);
                } else {

                    return view('rapport/bekijken', ['cijfer' => $cijfer, 'cijfer1' => $cijfer1, 'cijfer2' => $cijfer2,
                        'leerling' => $leerling, 'notitie1' => $notitie1, 'notitie2' => $notitie2, 'zelfknap1' => $zelfknap1, 'mensknap1' => $mensknap1,
                        'werkknap1' => $werkknap1, 'zelfknap2' => $zelfknap2, 'mensknap2' => $mensknap2, 'werkknap2' => $werkknap2,
                        'check1' => $check1, 'check2' => $check2, 'check3' => $check3, 'ouderbekeken' => $ouderbekeken, 'ouderbekeken2' => $ouderbekeken2, 'leerlingbekeken' => $leerlingbekeken, 'leerlingbekeken2' => $leerlingbekeken2]);

                }
            }
        }
    }

    public function ShowWijzigen($id)
    {
        if (Auth::user()->hasRole('leerkracht')) {
            $jaar = $this->Schooljaar();

            $leerling = DB::table('leerling')
                ->where(['leerlingid' => $id])
                ->select('voornaam', 'tussenvoegsel', 'achternaam')
                ->first();

            $rid1 = DB::table('rapport')
                ->where(['leerlingid' => $id])
                ->where(['jaar' => $jaar])
                ->where(['naam' => 'rapport 1'])
                ->select('rapportid')
                ->first();

            $rid2 = DB::table('rapport')
                ->where(['leerlingid' => $id])
                ->where(['jaar' => $jaar])
                ->where(['naam' => 'rapport 2'])
                ->select('rapportid')
                ->first();


            $cijferKnap = array('plantje_klein.png', 'plantje_middel.png', 'plantje_groot.png');

            if ($rid1 == null && $rid2 == null) {
                return view('rapport/wijzigen', ['id' => $id, 'rid1' => $rid1, 'rid2' => $rid2]);
            } else {
            }

            if ($rid1 == null) {
                $notitie2 = DB::table('rapport')
                    ->where(['leerlingid' => $id])
                    ->where(['jaar' => $jaar])
                    ->where(['naam' => 'rapport 2'])
                    ->select('notitie')
                    ->first();

                $rapport2 = DB::table('beoordeling')
                    ->join('vak', 'beoordeling.vakid', '=', 'vak.vakid')
                    ->where('beoordeling.rapportid', '=', $rid2->rapportid)
                    ->select('beoordeling.cijfer', 'vak.naam', 'vak.vakid')
                    ->get();

                $zelfknap2 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid2->rapportid)
                    ->where('categorie', '=', 'zelfknap')
                    ->whereIn('reflectie.leerkracht', $cijferKnap)
                    ->select('reflectie.leerkracht', 'knap.naam', 'knap.knapid')
                    ->get();

                $mensknap2 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid2->rapportid)
                    ->where('categorie', '=', 'mensknap')
                    ->select('reflectie.leerkracht', 'knap.naam', 'knap.knapid')
                    ->get();

                $werkknap2 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid2->rapportid)
                    ->where('categorie', '=', 'werkknap')
                    ->select('reflectie.leerkracht', 'knap.naam', 'knap.knapid')
                    ->get();

                return view('rapport/wijzigen', ['rapport2' => $rapport2, 'id' => $id, 'rid1' => $rid1, 'rid2' => $rid2, 'notitie2' => $notitie2, 'zelfknap2' => $zelfknap2, 'mensknap2' => $mensknap2, '$werkknap2' => $werkknap2]);
            } else {
                $notitie1 = DB::table('rapport')
                    ->where(['leerlingid' => $id])
                    ->where(['jaar' => $jaar])
                    ->where(['rapportid' => $rid1->rapportid])
                    ->select('notitie')
                    ->first();

                $rapport1 = DB::table('beoordeling')
                    ->join('vak', 'beoordeling.vakid', '=', 'vak.vakid')
                    ->where('beoordeling.rapportid', '=', $rid1->rapportid)
                    ->select('beoordeling.cijfer', 'vak.naam', 'vak.vakid')
                    ->get();

                $zelfknap1 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid1->rapportid)
                    ->where('categorie', '=', 'zelfknap')
                    ->whereIn('reflectie.leerkracht', $cijferKnap)
                    ->select('reflectie.leerkracht', 'knap.naam', 'knap.knapid')
                    ->get();

                $mensknap1 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid1->rapportid)
                    ->where('categorie', '=', 'mensknap')
                    ->select('reflectie.leerkracht', 'knap.naam', 'knap.knapid')
                    ->get();

                $werkknap1 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid1->rapportid)
                    ->where('categorie', '=', 'werkknap')
                    ->select('reflectie.leerkracht', 'knap.naam', 'knap.knapid')
                    ->get();

            }
            if ($rid2 == null) {
                return view('rapport/wijzigen', ['rapport1' => $rapport1, 'id' => $id, 'rid1' => $rid1, 'rid2' => $rid2, 'notitie1' => $notitie1, 'zelfknap1' => $zelfknap1, 'mensknap1' => $mensknap1, 'werkknap1' => $werkknap1]);
            } else {

                $notitie2 = DB::table('rapport')
                    ->where(['leerlingid' => $id])
                    ->where(['jaar' => $jaar])
                    ->where(['naam' => 'rapport 2'])
                    ->select('notitie')
                    ->first();

                $rapport2 = DB::table('beoordeling')
                    ->join('vak', 'beoordeling.vakid', '=', 'vak.vakid')
                    ->where('beoordeling.rapportid', '=', $rid2->rapportid)
                    ->select('beoordeling.cijfer', 'vak.naam', 'vak.vakid')
                    ->get();

                $zelfknap2 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid2->rapportid)
                    ->where('categorie', '=', 'zelfknap')
                    ->whereIn('reflectie.leerkracht', $cijferKnap)
                    ->select('reflectie.leerkracht', 'knap.naam', 'knap.knapid')
                    ->get();

                $mensknap2 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid2->rapportid)
                    ->where('categorie', '=', 'mensknap')
                    ->select('reflectie.leerkracht', 'knap.naam', 'knap.knapid')
                    ->get();

                $werkknap2 = DB::table('reflectie')
                    ->join('knap', 'reflectie.knapid', '=', 'knap.knapid')
                    ->where('reflectie.rapportid', '=', $rid2->rapportid)
                    ->where('categorie', '=', 'werkknap')
                    ->select('reflectie.leerkracht', 'knap.naam', 'knap.knapid')
                    ->get();
                return view('rapport/wijzigen', ['rapport1' => $rapport1, 'rapport2' => $rapport2, 'id' => $id, 'rid1' => $rid1, 'rid2' => $rid2, 'notitie1' => $notitie1, 'notitie2' => $notitie2, 'zelfknap1' => $zelfknap1, 'mensknap1' => $mensknap1, 'werkknap1' => $werkknap1, 'zelfknap2' => $zelfknap2, 'mensknap2' => $mensknap2, 'werkknap2' => $werkknap2]);
            }
        } else {
            return redirect()->route('home');


        }
    }


    public
    function UpdateCijfer(Request $request)
    {

        $jaar = $this->Schooljaar();

//Rapport1
        if (isset($request->rapportid1)) {
            if (isset($request->resultaten)) {
                //foreach Cijfers
                foreach ($request->resultaten as $key => $value) {
                    DB::table('beoordeling')
                        ->where('rapportid', '=', $request->rapportid1)
                        ->where('vakid', '=', $key)
                        ->update(['cijfer' => $value]);
                }
            }

            //nottitie
            DB::table('rapport')
                ->where(['leerlingid' => $request->leerlingid])
                ->where(['jaar' => $jaar])
                ->where(['rapportid' => $request->rapportid1])
                ->update(['notitie' => $request->notitie1]);

            //foreach x3 knap
            if (!empty($request->zelfknap)) {
                foreach ($request->zelfknap as $key => $value) {
                    DB::table('reflectie')
                        ->where('rapportid', '=', $request->rapportid1)
                        ->where('knapid', '=', $key)
                        ->update(['leerkracht' => $value]);
                }

                foreach ($request->mensknap as $key => $value) {
                    DB::table('reflectie')
                        ->where('rapportid', '=', $request->rapportid1)
                        ->where('knapid', '=', $key)
                        ->update(['leerkracht' => $value]);
                }
                foreach ($request->werkknap as $key => $value) {
                    DB::table('reflectie')
                        ->where('rapportid', '=', $request->rapportid1)
                        ->where('knapid', '=', $key)
                        ->update(['leerkracht' => $value]);
                }
            }
        }

        if (isset($request->rapportid2)) {
            if (isset($request->resultaten2)) {
                //foreach Cijfers
                foreach ($request->resultaten2 as $key => $value) {
                    DB::table('beoordeling')
                        ->where('rapportid', '=', $request->rapportid2)
                        ->where('vakid', '=', $key)
                        ->update(['cijfer' => $value]);
                }
            }


            DB::table('rapport')
                ->where(['leerlingid' => $request->leerlingid])
                ->where(['jaar' => $jaar])
                ->where(['rapportid' => $request->rapportid2])
                ->update(['notitie' => $request->notitie2]);

            if (isset($request->zelfknap2)) {
                foreach ($request->zelfknap2 as $key => $value) {
                    DB::table('reflectie')
                        ->where('rapportid', '=', $request->rapportid2)
                        ->where('knapid', '=', $key)
                        ->update(['leerkracht' => $value]);
                }

                foreach ($request->mensknap2 as $key => $value) {
                    DB::table('reflectie')
                        ->where('rapportid', '=', $request->rapportid2)
                        ->where('knapid', '=', $key)
                        ->update(['leerkracht' => $value]);
                }
                foreach ($request->werkknap2 as $key => $value) {
                    DB::table('reflectie')
                        ->where('rapportid', '=', $request->rapportid2)
                        ->where('knapid', '=', $key)
                        ->update(['leerkracht' => $value]);
                }
            }
        }
        $succes = "Rapport is aangepast";
        return redirect()->route('wijzig')->with('succes', $succes);

    }

    public
    function OudersCijfers()
    {
        $id = Auth::user()->id;
        $ouder = DB::table('ouder')
            ->where('userid', '=', $id)
            ->select('ouderid')
            ->first();

        $leerlingen = DB::table('leerling_ouder')
            ->join('leerling', 'leerling.leerlingid', '=', 'leerling_ouder.leerlingid')
            ->where('leerling_ouder.ouderid', '=', $ouder->ouderid)
            ->select('leerling.leerlingid', 'leerling.voornaam', 'leerling.tussenvoegsel', 'leerling.achternaam')
            ->get();


        return view('rapport/bekijken_kiezen', ['leerlingen' => $leerlingen]);
    }

}