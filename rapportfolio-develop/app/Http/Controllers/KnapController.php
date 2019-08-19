<?php

namespace App\Http\Controllers;

use App;
use App\Rapport;
use App\Reflectie;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KnapController extends Controller
{
    public static function CheckKnapIngevuld($leerlingid, $rapport, $persoon)
    {
        if(date("m") < 8)
        {
            $jaar1 = date("Y") - 1;
            $jaar2 = date("Y");
        }
            
        else
        {

            $jaar1 = date("Y");
            $jaar2 = date("Y") + 1;
        }
            
            
        $jaar = $jaar1."-".$jaar2;

        $rapportid = DB::table('rapport')
        ->where('leerlingid', '=', $leerlingid)
        ->where('naam', '=', $rapport)
        ->where('jaar', '=', $jaar)
        ->select('rapportid')
        ->first();
    
        if(!isset($rapportid))
        {
            return 0;
        }

        $reflectie = DB::table('reflectie')
            ->where('rapportid', '=', $rapportid->rapportid)
            ->where($persoon, '!=', null)
            ->groupBy('rapportid')
            ->count();
        if($reflectie > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }

    public function Schooljaar()
    {
        if(date("m") < 8)
        {
            $jaar1 = date("Y") - 1;
            $jaar2 = date("Y");
        }
            
        else
        {

            $jaar1 = date("Y");
            $jaar2 = date("Y") + 1;
        }
            
            
            $schooljaar = $jaar1."-".$jaar2;

            return $schooljaar;
    }

    public function InvullenNamen(Request $request)
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

        return view('knap/invullen_naam', ['leerlingen' => $leerlingen, 'succes' => $succes]);
    }

    public function getKnapLeerkracht1($id)
    {
        $jaar = $this->Schooljaar();

        $rapportid = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 1")
            ->where('jaar', '=', $this->Schooljaar())
            ->select('rapportid')
            ->first();
        if ($rapportid == null) {
            $reflectie = null;
        } else {

            $reflectie = DB::table('reflectie')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->select('leerkracht')
                ->first();
        }
        if (isset($reflectie)) {
            $error = "Knap voor deze leerling  in rapport 1 is al ingevuld";
            return redirect()->back()->with('error', $error);
        } else {

            $zelfknap1 = DB::table('knap')
                ->where('knapid', '=', '3')
                ->select('naam', 'knapid')
                ->get();

            $zelfknap2 = DB::table('knap')
                ->where('knapid', '=', '4')
                ->select('naam', 'knapid')
                ->get();

            $mensknap = DB::table('knap')
                ->where('categorie', '=', 'mensknap')
                ->select('naam', 'knapid')
                ->get();

            $werkknap = DB::table('knap')
                ->where('categorie', '=', 'werkknap')
                ->select('naam', 'knapid')
                ->get();

            $cijfer = array('plantje_klein.png', 'plantje_middel.png', 'plantje_groot.png');

            return view('knap/invullen1', ['id' => $id, 'jaar' => $jaar, 'zelfknap1' => $zelfknap1, 'zelfknap2' => $zelfknap2, 'mensknap' => $mensknap, 'werkknap' => $werkknap, 'cijfer' => $cijfer]);
        }
    }

    public function getKnapLeerkracht2($id)
    {
        $jaar = $this->Schooljaar();

        $rapportid = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 2")
            ->where('jaar', '=', $this->Schooljaar())
            ->select('rapportid')
            ->first();
        if ($rapportid == null) {
            $reflectie = null;
        } else {
            $reflectie = DB::table('reflectie')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->select('leerkracht')
                ->first();
        }
        if (isset($reflectie)) {
            $error = "Knap voor deze leerling  in rapport 2 is al ingevuld";
            return redirect()->back()->with('error', $error);
        } else {

            $zelfknap1 = DB::table('knap')
                ->where('knapid', '=', '3')
                ->select('naam', 'knapid')
                ->get();

            $zelfknap2 = DB::table('knap')
                ->where('knapid', '=', '4')
                ->select('naam', 'knapid')
                ->get();

            $mensknap = DB::table('knap')
                ->where('categorie', '=', 'mensknap')
                ->select('naam', 'knapid')
                ->get();

            $werkknap = DB::table('knap')
                ->where('categorie', '=', 'werkknap')
                ->select('naam', 'knapid')
                ->get();

            $cijfer = array('plantje_klein.png', 'plantje_middel.png', 'plantje_groot.png');

            return view('knap/invullen2', ['id' => $id, 'jaar' => $jaar, 'zelfknap1' => $zelfknap1, 'zelfknap2' => $zelfknap2, 'mensknap' => $mensknap, 'werkknap' => $werkknap, 'cijfer' => $cijfer]);
        }
    }

    public function InvullenKnapLeerkracht1($id, Request $request)
    {
        
        $request->validate([
            'zelfknap.3' => 'required',
            'zelfknap.4' => 'required',
            'mensknap.5' => 'required',
            'mensknap.6' => 'required',
            'mensknap.7' => 'required',
            'mensknap.8' => 'required',
            'werkknap.9' => 'required',
            'werkknap.10' => 'required',
            'werkknap.11' => 'required',
            'werkknap.12' => 'required',
        ]);

        $jaar = $this->Schooljaar();

        $rapport = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 1")
            ->where('jaar','=',$jaar)
            ->select('rapportid')
            ->first();

        if (!isset($rapport)) {
            $groepid = DB::table('leerling')
                ->where('leerlingid', '=', $id)
                ->select('groepid')
                ->first();

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

        $rap = DB::table('rapport')
            ->where('leerlingid', $id)
            ->where(['jaar' => $jaar])
            ->where(['naam' => 'rapport 1'])
            ->select('rapportid')
            ->first();

        DB::table('reflectie')
            ->insert([
                'rapportid' => $rap->rapportid,
                'knapid' => 1,
                'kind' => null,
                'leerkracht' => null,
            ]);
        DB::table('reflectie')
            ->insert([
                'rapportid' => $rap->rapportid,
                'knapid' => 2,
                'kind' => null,
                'leerkracht' => null,
            ]);


        foreach ($request->zelfknap as $key => $value) {
            $rap = Rapport::where('leerlingid', $id)->where(['jaar' => $jaar])->where(['naam' => 'rapport 1'])->first();

            $cijfer = new Reflectie();
            $cijfer->leerkracht = $value;
            $cijfer->kind = null;
            $cijfer->knapid = $key;
            $cijfer->rapportid = $rap->rapportid;
            $cijfer->save();
        }
        foreach ($request->mensknap as $key => $value) {
            $rap = Rapport::where('leerlingid', $id)->where(['jaar' => $jaar])->where(['naam' => 'rapport 1'])->first();

            $cijfer = new Reflectie();
            $cijfer->leerkracht = $value;
            $cijfer->kind = null;
            $cijfer->knapid = $key;
            $cijfer->rapportid = $rap->rapportid;
            $cijfer->save();
        }
        foreach ($request->werkknap as $key => $value) {
            $rap = Rapport::where('leerlingid', $id)->where(['jaar' => $jaar])->where(['naam' => 'rapport 1'])->first();

            $cijfer = new Reflectie();
            $cijfer->leerkracht = $value;
            $cijfer->kind = null;
            $cijfer->knapid = $key;
            $cijfer->rapportid = $rap->rapportid;
            $cijfer->save();
        }

        $succes = "Knap is ingevuld voor rapport 1";
        return redirect()->route('knapinvullennamen')->with('succes', $succes);
    }

    public function InvullenKnapLeerkracht2($id, Request $request)
    {
        $request->validate([
            'zelfknap.3' => 'required',
            'zelfknap.4' => 'required',
            'mensknap.5' => 'required',
            'mensknap.6' => 'required',
            'mensknap.7' => 'required',
            'mensknap.8' => 'required',
            'werkknap.9' => 'required',
            'werkknap.10' => 'required',
            'werkknap.11' => 'required',
            'werkknap.12' => 'required',
        ]);

        $jaar = $this->Schooljaar();

        $rapport = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 2")
            ->where('jaar','=',$jaar)
            ->select('rapportid')
            ->first();

        if (!isset($rapport)) {
            $groepid = DB::table('leerling')
                ->where('leerlingid', '=', $id)
                ->select('groepid')
                ->first();

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

        $rap = DB::table('rapport')
            ->where('leerlingid', $id)
            ->where(['jaar' => $jaar])
            ->where(['naam' => 'rapport 2'])
            ->select('rapportid')
            ->first();

        DB::table('reflectie')
            ->insert([
                'rapportid' => $rap->rapportid,
                'knapid' => 1,
                'kind' => null,
                'leerkracht' => null,
            ]);
        DB::table('reflectie')
            ->insert([
                'rapportid' => $rap->rapportid,
                'knapid' => 2,
                'kind' => null,
                'leerkracht' => null,
            ]);

        foreach ($request->zelfknap as $key => $value) {
            $rap = Rapport::where('leerlingid', $id)->where(['jaar' => $jaar])->where(['naam' => 'rapport 2'])->first();

            $cijfer = new Reflectie();
            $cijfer->leerkracht = $value;
            $cijfer->kind = null;
            $cijfer->knapid = $key;
            $cijfer->rapportid = $rap->rapportid;
            $cijfer->save();
        }
        foreach ($request->mensknap as $key => $value) {
            $rap = Rapport::where('leerlingid', $id)->where(['jaar' => $jaar])->where(['naam' => 'rapport 2'])->first();

            $cijfer = new Reflectie();
            $cijfer->leerkracht = $value;
            $cijfer->kind = null;
            $cijfer->knapid = $key;
            $cijfer->rapportid = $rap->rapportid;
            $cijfer->save();
        }
        foreach ($request->werkknap as $key => $value) {
            $rap = Rapport::where('leerlingid', $id)->where(['jaar' => $jaar])->where(['naam' => 'rapport 2'])->first();

            $cijfer = new Reflectie();
            $cijfer->leerkracht = $value;
            $cijfer->kind = null;
            $cijfer->knapid = $key;
            $cijfer->rapportid = $rap->rapportid;
            $cijfer->save();
        }

        $succes = "Knap is ingevuld voor rapport 2";
        return redirect()->route('knapinvullennamen')->with('succes', $succes);
    }

    public function KiezenLeerling(Request $request)
    {
        $id = Auth::user()->id;

        $succes = $request->session()->get('succes');

        $leerlingid = DB::table('leerling')
            ->where('userid', '=', $id)
            ->select('leerlingid')
            ->first();

        return view('knap/kiezen_leerling', ['leerlingid' => $leerlingid, 'succes' => $succes]);
    }

    public function getKnapLeerling1($id)
    {
        $jaar = $this->Schooljaar();

        $rapportid = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 1")
            ->where('jaar', '=', $this->Schooljaar())
            ->select('rapportid')
            ->first();
        if(!isset($rapportid)){
            $error = "Er is nog geen rapport 1";
            return redirect()->back()->with('error', $error);
        }

        $reflectieleerkracht = DB::table('reflectie')
            ->where('rapportid', '=', $rapportid->rapportid)
            ->select('leerkracht')
            ->first();

        $reflectiekind = DB::table('reflectie')
            ->where('rapportid', '=', $rapportid->rapportid)
            ->select('kind')
            ->first();

        if (!isset($reflectieleerkracht)) {
            $error = "Knap voor jouw is nog niet ingevuld door jouw juf/meester";
            return redirect()->back()->with('error', $error);
        } else {

            if ($reflectiekind->kind != null) {
                $error = "Je hebt knap al ingevuld";
                return redirect()->back()->with('error', $error);
            } else {
                $zelfknap = DB::table('knap')
                    ->where('categorie', '=', 'zelfknap')
                    ->select('naam', 'knapid')
                    ->get();

                $mensknap = DB::table('knap')
                    ->where('categorie', '=', 'mensknap')
                    ->select('naam', 'knapid')
                    ->get();

                $werkknap = DB::table('knap')
                    ->where('categorie', '=', 'werkknap')
                    ->select('naam', 'knapid')
                    ->get();

                $cijfer = array('plantje_klein.png', 'plantje_middel.png', 'plantje_groot.png');

                return view('knap/invullen_leerling1', ['id' => $id, 'jaar' => $jaar, 'zelfknap' => $zelfknap, 'mensknap' => $mensknap, 'werkknap' => $werkknap, 'cijfer' => $cijfer]);
            }
        }
    }


    public
    function getKnapLeerling2($id)
    {
        $jaar = $this->Schooljaar();

        $rapportid = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 2")
            ->where('jaar', '=', $this->Schooljaar())
            ->select('rapportid')
            ->first();

        if(!isset($rapportid)){
            $error = "Er is nog geen rapport 2";
            return redirect()->back()->with('error', $error);
        }

        $reflectie = DB::table('reflectie')
            ->where('rapportid', '=', $rapportid->rapportid)
            ->select('leerkracht')
            ->first();
        $reflectiekind = DB::table('reflectie')
            ->where('rapportid', '=', $rapportid->rapportid)
            ->select('kind')
            ->first();

        if (!isset($reflectie)) {
            $error = "Knap voor jouw is nog niet ingevuld door jouw juf/meester";
            return redirect()->back()->with('error', $error);
        } else {
            if ($reflectiekind->kind != null) {
                $error = "Je hebt knap al ingevuld";
                return redirect()->back()->with('error', $error);
            } else {

                $zelfknap = DB::table('knap')
                    ->where('categorie', '=', 'zelfknap')
                    ->select('naam', 'knapid')
                    ->get();

                $mensknap = DB::table('knap')
                    ->where('categorie', '=', 'mensknap')
                    ->select('naam', 'knapid')
                    ->get();

                $werkknap = DB::table('knap')
                    ->where('categorie', '=', 'werkknap')
                    ->select('naam', 'knapid')
                    ->get();

                $cijfer = array('plantje_klein.png', 'plantje_middel.png', 'plantje_groot.png');

                return view('knap/invullen_leerling2', ['id' => $id, 'jaar' => $jaar, 'zelfknap' => $zelfknap, 'mensknap' => $mensknap, 'werkknap' => $werkknap, 'cijfer' => $cijfer]);
            }
        }
    }

    public
    function InvullenKnapLeerling1(Request $request, $id)
    {
        $request->validate([
            'zelfknap.1' => 'required',
            'zelfknap.2' => 'required',
            'zelfknap.3' => 'required',
            'zelfknap.4' => 'required',
            'mensknap.5' => 'required',
            'mensknap.6' => 'required',
            'mensknap.7' => 'required',
            'mensknap.8' => 'required',
            'werkknap.9' => 'required',
            'werkknap.10' => 'required',
            'werkknap.11' => 'required',
            'werkknap.12' => 'required',
        ]);

        $rapportid = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 1")
            ->where('jaar', '=', $this->Schooljaar())
            ->select('rapportid')
            ->first();

        foreach ($request->zelfknap as $key => $value) {
            DB::table('reflectie')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->where('knapid', '=', $key)
                ->update(['kind' => $value]);
        }
        foreach ($request->mensknap as $key => $value) {
            DB::table('reflectie')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->where('knapid', '=', $key)
                ->update(['kind' => $value]);
        }
        foreach ($request->werkknap as $key => $value) {
            DB::table('reflectie')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->where('knapid', '=', $key)
                ->update(['kind' => $value]);
        }

        $succes = "Knap voor rapport 1 is goed ingevuld";

        return redirect()->route('leerlingkiezen')->with('succes', $succes);

    }
    public
    function InvullenKnapLeerling2(request $request, $id)
    {
        $request->validate([
            'zelfknap.1' => 'required',
            'zelfknap.2' => 'required',
            'zelfknap.3' => 'required',
            'zelfknap.4' => 'required',
            'mensknap.5' => 'required',
            'mensknap.6' => 'required',
            'mensknap.7' => 'required',
            'mensknap.8' => 'required',
            'werkknap.9' => 'required',
            'werkknap.10' => 'required',
            'werkknap.11' => 'required',
            'werkknap.12' => 'required',
        ]);

        $rapportid = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->where('naam', '=', "rapport 2")
            ->where('jaar', '=', $this->Schooljaar())
            ->select('rapportid')
            ->first();

        foreach ($request->zelfknap as $key => $value) {
            DB::table('reflectie')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->where('knapid', '=', $key)
                ->update(['kind' => $value]);
        }
        foreach ($request->mensknap as $key => $value) {
            DB::table('reflectie')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->where('knapid', '=', $key)
                ->update(['kind' => $value]);
        }
        foreach ($request->werkknap as $key => $value) {
            DB::table('reflectie')
                ->where('rapportid', '=', $rapportid->rapportid)
                ->where('knapid', '=', $key)
                ->update(['kind' => $value]);
        }

        $succes = "Knap voor rapport 2 is goed ingevuld";

        return redirect()->route('leerlingkiezen')->with('succes', $succes);

    }
}