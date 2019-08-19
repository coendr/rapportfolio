<?php

namespace App\Http\Controllers;

use App;
use App\Rapport;
use Auth;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class NotitieController extends Controller
{
    public static function CheckNotitie1Ingevuld($leerlingid)
    {
        if (date("m") < 8) {
            $jaar1 = date("Y") - 1;
            $jaar2 = date("Y");
        } else {

            $jaar1 = date("Y");
            $jaar2 = date("Y") + 1;
        }

        $jaar = $jaar1 . "-" . $jaar2;

        $notitie = DB::table('rapport')
            ->where('leerlingid', '=', $leerlingid)
            ->where('naam', '=', 'rapport 1')
            ->where('jaar', '=', $jaar)
            ->select('notitie')
            ->first();

        if ($notitie == null) {
            return 0;
        }

        if ($notitie->notitie == null) {
            return 0;
        } else {
            return 1;
        }
    }

    public static function CheckNotitie2Ingevuld($leerlingid)
    {
        if (date("m") < 8) {
            $jaar1 = date("Y") - 1;
            $jaar2 = date("Y");
        } else {

            $jaar1 = date("Y");
            $jaar2 = date("Y") + 1;
        }

        $jaar = $jaar1 . "-" . $jaar2;

        $notitie = DB::table('rapport')
            ->where('leerlingid', '=', $leerlingid)
            ->where('naam', '=', 'rapport 2')
            ->where('jaar', '=', $jaar)
            ->select('notitie')
            ->first();

        if ($notitie == null) {
            return 0;
        }

        if ($notitie->notitie == null) {
            return 0;
        } else {
            return 1;
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

    public function index(Request $request)
    {
        $succes = $request->session()->get('succes');


        $id = Auth::user()->id;
        $groepid = DB::table('leerkracht')
            ->where('userid', '=', $id)
            ->select('groepid')
            ->first();

        $leerlingen = DB::table('leerling')
            ->where('groepid', '=', $groepid->groepid)
            ->select('voornaam', 'tussenvoegsel', 'achternaam', 'leerlingid')
            ->orderBy('voornaam')
            ->get();


        return view('notitie/invullen_kiezen', ['leerlingen' => $leerlingen, 'succes' => $succes]);
    }

    public function getLeerling1($id)
    {

        $jaar = $this->Schooljaar();

        $leerling = DB::table('leerling')
            ->where('leerlingid', '=', $id)
            ->select('leerlingid', 'voornaam', 'tussenvoegsel', 'achternaam')
            ->first();

        $notitie = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', 'rapport 1')
            ->where('jaar', '=', $jaar)
            ->select('notitie')
            ->first();

        if ($notitie->notitie == null) {

            return view('notitie/invullen1', ['leerling' => $leerling]);
        } else {

            return redirect()->back()->with('error', "Notitie is al ingevuld");

        }
    }

    public function getLeerling2($id)
    {

        $jaar = $this->Schooljaar();

        $leerling = DB::table('leerling')
            ->where('leerlingid', '=', $id)
            ->select('leerlingid', 'voornaam', 'tussenvoegsel', 'achternaam')
            ->first();

        $notitie = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', 'rapport 2')
            ->where('jaar', '=', $jaar)
            ->select('notitie')
            ->first();

        if ($notitie == null) {
            return redirect()->back()->with('error', "Dit rapport is nog niet aangemaakt.");
        }

        if ($notitie->notitie == null) {

            return view('notitie/invullen2', ['leerling' => $leerling]);
        } else {

            return redirect()->back()->with('error', "Notitie is al ingevuld");

        }
    }

    public function InsertNotitie1(Request $request, $id)
    {
        $leerkrachtid = Auth::user()->id;
        $groepid = DB::table('leerkracht')
            ->where('userid', '=', $leerkrachtid)
            ->select('groepid')
            ->first();

        $leerlingid = DB::table('leerling')
            ->where('groepid', '=', $groepid->groepid)
            ->select('leerlingid')
            ->first();

        $jaar = $this->Schooljaar();

        $rapport = DB::table('rapport')
            ->where('leerlingid', '=', $leerlingid->leerlingid)
            ->where('naam', '=', "rapport 1")
            ->where('jaar', '=', $jaar)
            ->select('rapportid')
            ->first();

        if (!isset($rapport)) {
            $jaar = $this->Schooljaar();

            $allleerlingen = DB::table('leerling')
                ->where('groepid', '=', $groepid->groepid)
                ->select('leerlingid')
                ->get();

            foreach ($allleerlingen as $a) {
                $newrapport = new Rapport();
                $newrapport->naam = "rapport 1";
                $newrapport->leerlingid = $a->leerlingid;
                $newrapport->groepid = $groepid->groepid;
                $newrapport->jaar = $jaar;
                $newrapport->notitie = null;
                $newrapport->ouder_bekeken = 0;
                $newrapport->leerling_bekeken = 0;
                $newrapport->save();
            }
        }

        DB::table('rapport')
            ->where('jaar', '=', $jaar)
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 1")
            ->update(['notitie' => $request->notitie]);

        $succes = "Notitie ingevuld voor rapport 1";
        return redirect()->route('notitie')->with('succes', $succes);
    }


    public function InsertNotitie2(Request $request, $id)
    {
        $leerkrachtid = Auth::user()->id;
        $groepid = DB::table('leerkracht')
            ->where('userid', '=', $leerkrachtid)
            ->select('groepid')
            ->first();

        $leerlingid = DB::table('leerling')
            ->where('groepid', '=', $groepid->groepid)
            ->select('leerlingid')
            ->first();

        $jaar = $this->Schooljaar();

        $rapport = DB::table('rapport')
            ->where('leerlingid', '=', $leerlingid->leerlingid)
            ->where('naam', '=', "rapport 2")
            ->where('jaar', '=', $jaar)
            ->select('rapportid')
            ->first();

        if (!isset($rapport)) {

            $jaar = $this->Schooljaar();

            $allleerlingen = DB::table('leerling')
                ->where('groepid', '=', $groepid->groepid)
                ->select('leerlingid')
                ->get();

            foreach ($allleerlingen as $a) {
                $newrapport = new Rapport();
                $newrapport->naam = "rapport 2";
                $newrapport->leerlingid = $a->leerlingid;
                $newrapport->groepid = $groepid->groepid;
                $newrapport->jaar = $jaar;
                $newrapport->notitie = null;
                $newrapport->ouder_bekeken = 0;
                $newrapport->leerling_bekeken = 0;
                $newrapport->save();
            }
        }

        DB::table('rapport')
            ->where('jaar', '=', $jaar)
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 2")
            ->update(['notitie' => $request->notitie]);

        $succes = "Notitie ingevuld voor rapport 2";
        return redirect()->route('notitie')->with('succes', $succes);
    }

    public function NotitieLeerling()
    {
        $id = Auth::user()->id;

        $leerlingid = DB::table('leerling')
            ->where('userid', '=', $id)
            ->select('leerlingid')
            ->first();

        return view('notitie/kiezen_rapport', ['leerlingid' => $leerlingid]);
    }

    public function LeerlingNotitie1($id)
    {
        $jaar = $this->Schooljaar();

        $rapport = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 1")
            ->where('jaar', '=', $jaar)
            ->select('rapportid')
            ->first();

        if (!isset($rapport)) {
            return redirect()->back()->with('error', "Je juf/meester moet je rapport nog invullen!");
        } else {
            $jaar = $this->Schooljaar();

            $leerling = DB::table('leerling')
                ->where('leerlingid', '=', $id)
                ->select('leerlingid')
                ->first();

            $notitie = DB::table('rapport')
                ->where('leerlingid', '=', $id)
                ->where('naam', '=', 'rapport 1')
                ->where('jaar', '=', $jaar)
                ->select('notitie_leerling')
                ->first();

            if ($notitie->notitie_leerling == Null) {

                return view('notitie/leerling1', ['leerling' => $leerling]);
            } else {
                return redirect()->back()->with('error', "Notitie is al ingevuld!");
            }
        }
    }

    public function LeerlingNotitie2($id)
    {
        $jaar = $this->Schooljaar();

        $rapport = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 2")
            ->where('jaar', '=', $jaar)
            ->select('rapportid')
            ->first();

        if (!isset($rapport)) {
            return redirect()->back()->with('error', "Je juf/meester moet je rapport nog invullen!");
        } else {

            $jaar = $this->Schooljaar();

            $leerling = DB::table('leerling')
                ->where('leerlingid', '=', $id)
                ->select('leerlingid')
                ->first();

            $notitie = DB::table('rapport')
                ->where('leerlingid', '=', $id)
                ->where('naam', '=', 'rapport 2')
                ->where('jaar', '=', $jaar)
                ->select('notitie_leerling')
                ->first();

            if ($notitie->notitie_leerling == Null) {

                return view('notitie/leerling2', ['leerling' => $leerling]);
            } else {
                return redirect()->back()->with('error', "Notitie is al ingevuld!");
            }
        }
    }

    public function InvullenLeerling1(Request $request, $id)
    {
        $jaar = $this->Schooljaar();


        DB::table('rapport')
            ->where('jaar', '=', $jaar)
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 1")
            ->update(['notitie_leerling' => $request->notitie]);
        $succes = "De notitie is toegevoegd!";

        return view('landingpage', ['succes' => $succes]);
    }

    public function InvullenLeerling2(Request $request, $id)
    {
        $jaar = $this->Schooljaar();


        DB::table('rapport')
            ->where('jaar', '=', $jaar)
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 2")
            ->update(['notitie_leerling' => $request->notitie]);
        $succes = "De notitie is toegevoegd!";

        return view('landingpage', ['succes' => $succes]);
    }
}