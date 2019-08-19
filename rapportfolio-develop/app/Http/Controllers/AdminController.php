<?php

namespace App\Http\Controllers;

use App;
use App\Groep;
use App\Leerkracht;
use App\Leerling;
use App\User;
use App\Vak;
use Auth;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    public function importLeerling()
    {
        return view('admin/leerling_toevoegen');
    }

    public
    function importLeerkracht()
    {
        return view('admin/leerkracht_toevoegen');
    }

    public
    function importLeerlingExcel()
    {
        $count = 0;
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {

                    $getleerling = DB::table('leerling')
                        ->where('leerlingid', '=', $value->leerlingnummer)
                        ->first();
                    $getusername = DB::table('users')
                        ->where('username', '=', $value->voornaam . $value->tussenvoegsel . $value->achternaam)
                        ->first();

                    if (!isset($getleerling) && !isset($getusername)) {

                        $groepid = DB::table('groep')
                            ->where('naam', '=', $value->groep)
                            ->select('groepid')
                            ->first();
                        $user = new User();
                        $leerling = new Leerling();

                        $parts = explode(", ",$value->achternaam);
                        $achternaam = $parts[0];
                        if (isset($parts[1])) {
                            $tussenvoegsel = $parts[1];
                        }else{
                            $tussenvoegsel = null;
                        }
                        $user->username = $value->voornaam . $tussenvoegsel . $achternaam;
                        $user->password = bcrypt('Welkom01');
                        $user->force_password_change = 1;
                        $user->role = 'leerling';
                        $user->save();

                        $lastInsertedId = $user->id;

                        $leerling->leerlingid = $value->leerlingnummer;
                        $leerling->userid = $lastInsertedId;
                        $leerling->voornaam = $value->voornaam;
                        $leerling->tussenvoegsel = $tussenvoegsel;
                        $leerling->achternaam = $achternaam;
                        if(empty($groepid->groepid)){
                            DB::table('users')
                                ->where('id','=',$lastInsertedId)
                                ->delete();

                            return back()->with('error', 'Groep '.$value->groep.' bestaat nog niet');
                        }
                        $leerling->groepid = $groepid->groepid;
                        $leerling->start_datum = NULL;
                        $leerling->eind_datum = NULL;
                        $leerling->save();


                        $count++;
                    }
                }
            }
        }
        if ($count == 0) {
            return back()->with('error', 'error! ' . $count . ' leerlingen zijn geimporteerd in het systeem');
        } else if ($count == 1) {
            return back()->with('succes', 'succes! ' . $count . ' leerling is geimporteerd in het systeem');
        } else
            return back()->with('succes', 'succes! ' . $count . ' leerlingen zijn geimporteerd in het systeem');


    }

    public
    function importLeerkrachtExcel()
    {
        $count = 0;
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {

                    $getleerkracht = DB::table('leerkracht')
                        ->where('leerkrachtid', '=', $value->leerkrachtid)
                        ->first();
                    $getusername = DB::table('users')
                        ->where('username', '=', $value->voornaam . $value->tussenvoegsel . $value->achternaam)
                        ->first();

                    if (!isset($getleerkracht) && !isset($getusername)) {

                        $groepid = DB::table('groep')
                            ->where('naam', '=', $value->groep)
                            ->select('groepid')
                            ->first();
                        $user = new User();
                        $leerkracht = new Leerkracht();

                        $user->username = $value->voornaam . $value->tussenvoegsel . $value->achternaam;
                        $user->password = bcrypt('Welkom01');
                        $user->force_password_change = 1;
                        $user->role = 'leerkracht';
                        $user->save();

                        $lastInsertedId = $user->id;

                        $leerkracht->leerkrachtid = $value->leerkrachtid;
                        $leerkracht->userid = $lastInsertedId;
                        $leerkracht->voornaam = $value->voornaam;
                        $leerkracht->tussenvoegsel = $value->tussenvoegsel;
                        $leerkracht->achternaam = $value->achternaam;
                        if(empty($groepid->groepid)){
                            DB::table('users')
                                ->where('id','=',$lastInsertedId)
                                ->delete();

                            return back()->with('error', 'Groep '.$value->groep.' bestaat nog niet');
                        }
                        $leerkracht->groepid = $groepid->groepid;
                        $leerkracht->save();

                        $count++;
                    }
                }
            }
        }
        if ($count == 0) {
            return back()->with('error', 'error! ' . $count . ' leerkrachten zijn geimporteerd in het systeem');
        } else if ($count == 1) {
            return back()->with('succes', 'succes! ' . $count . ' leerkracht is geimporteerd in het systeem');
        } else
            return back()->with('succes', 'succes! ' . $count . ' leerkrachten zijn geimporteerd in het systeem');
    }

    public function getGroep()
    {
        $groep3 = DB::table('groep')
            ->where('groep', '=', 3)
            ->select('naam', 'groepid')
            ->get();
        $groep4 = DB::table('groep')
            ->where('groep', '=', 4)
            ->select('naam', 'groepid')
            ->get();
        $groep5 = DB::table('groep')
            ->where('groep', '=', 5)
            ->select('naam', 'groepid')
            ->get();
        $groep6 = DB::table('groep')
            ->where('groep', '=', 6)
            ->select('naam', 'groepid')
            ->get();
        $groep7 = DB::table('groep')
            ->where('groep', '=', 7)
            ->select('naam', 'groepid')
            ->get();
        $groep8 = DB::table('groep')
            ->where('groep', '=', 8)
            ->select('naam', 'groepid')
            ->get();

        return view('admin/aanpassen', ['groep3' => $groep3, 'groep4' => $groep4, 'groep5' => $groep5, 'groep6' => $groep6, 'groep7' => $groep7, 'groep8' => $groep8,]);
    }

    public function getLeerling($groep)
    {
        $leerlingen = DB::table('leerling')
            ->join('users', 'leerling.userid', '=', 'users.id')
            ->where('leerling.groepid', '=', $groep)
            ->get();

        $leerling = DB::table('leerling')
            ->where('groepid', '=', $groep)
            ->first();
        if (!isset($leerling)) {
            return redirect()->back()->with('error', 'groep is leeg!');
        } else
            $groepnaam = DB::table('groep')
                ->where('groepid', '=', $leerling->groepid)
                ->first();


        return view('admin/aanpassen_kies', ['leerlingen' => $leerlingen, 'groepnaam' => $groepnaam, 'groep' => $groep]);
    }

    public function getLeerkracht()
    {
        $leerkrachten = DB::table('leerkracht')
            ->join('users', 'leerkracht.userid', '=', 'users.id')
            ->join('groep', 'leerkracht.groepid', '=', 'groep.groepid')
            ->get();

        return view('admin/aanpassen_kies_leerkracht', ['leerkrachten' => $leerkrachten]);
    }

    public function verwijderleerling($groep, $id)
    {
        $rapportid = DB::table('rapport')
            ->where('leerlingid', '=', $id)
            ->select('rapportid')
            ->first();

        DB::table('users')
            ->join('leerling', 'users.id', '=', 'leerling.userid')
            ->where('leerling.leerlingid', '=', $id)
            ->delete();
        DB::table('leerling')
            ->where('leerling.leerlingid', '=', $id)
            ->delete();


        if (isset($rapportid)) {
            DB::table('rapport')
                ->join('beoordeling', 'rapport.rapportid', '=', 'beoordeling.rapportid')
                ->join('reflectie', 'rapport.rapportid', '=', 'reflectie.rapportid')
                ->where('rapport.rapportid', '=', $rapportid->rapportid)
                ->delete();
        } else

            $leerling = DB::table('leerling')
                ->where('groepid', '=', $groep)
                ->select('leerlingid')
                ->first();


        if (isset($leerling)) {
            return redirect()->back()->with('succes', 'Leerling verwijderd!');
        } else
            return redirect()->route('getgroep')->with('succes', 'Leerling verwijderd!');
    }

    public function deleteleerkracht($id)
    {
        DB::table('users')
            ->join('leerkracht', 'users.id', '=', 'leerkracht.userid')
            ->where('leerkracht.leerkrachtid', '=', $id)
            ->delete();
        DB::table('leerkracht')
            ->where('leerkracht.leerkrachtid', '=', $id)
            ->delete();

        $leerkracht = DB::table('leerkracht')
            ->select('leerkrachtid')
            ->first();

//        if (isset($leerkracht)) {
        return redirect()->back()->with('succes', 'Leerkracht verwijderd!');
//        } else
//            return redirect()->route('home');
    }

    public function deleteouder($id)
    {
        DB::table('users')
            ->join('ouder', 'users.id', '=', 'ouder.userid')
            ->where('ouder.ouderid', '=', $id)
            ->delete();
        DB::table('ouder')
            ->where('ouderid', '=', $id)
            ->delete();

        Auth::logout();

        return view('login')->with('succes', 'Ouder verwijderd!');

    }

    public function importVak()
    {
        return view('admin/vak_toevoegen');
    }

    public
    function importVakExcel()
    {
        $count = 0;
        if (Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {

                    $getvak = DB::table('vak')
                        ->where('naam', '=', $value->naam)
                        ->where('groep', '=', $value->groep)
                        ->first();

                    if (!isset($getvak)) {

                        $vak = new Vak();

                        $vak->naam = $value->naam;
                        $vak->groep = $value->groep;
                        $vak->save();

                        $count++;
                    }
                }
            }
        }
        if ($count == 0) {
            return back()->with('error', 'error! ' . $count . ' vakken zijn geimporteerd in het systeem');
        } else if ($count == 1) {
            return back()->with('succes', 'succes! ' . $count . ' vak is geimporteerd in het systeem');
        } else {
            return back()->with('succes', 'succes! ' . $count . ' vakken zijn geimporteerd in het systeem');
        }
    }

    public function editleerkracht($id)
    {
        $leerkracht = DB::table('leerkracht')
            ->join('users', 'leerkracht.userid', '=', 'users.id')
            ->join('groep', 'leerkracht.groepid', '=', 'groep.groepid')
            ->where('leerkracht.leerkrachtid', '=', $id)
            ->select('leerkracht.leerkrachtid', 'leerkracht.voornaam', 'leerkracht.tussenvoegsel', 'leerkracht.achternaam', 'users.id', 'users.email', 'groep.groepid', 'groep.naam')
            ->first();

        $groep = DB::table('groep')
            ->select('naam', 'groepid')
            ->get();


        return view('admin/aanpassen_leerkracht', ['leerkracht' => $leerkracht, 'groep' => $groep]);
    }

    public function editleerling($groep, $id)
    {
        $leerling = DB::table('leerling')
            ->join('users', 'leerling.userid', '=', 'users.id')
            ->join('groep', 'leerling.groepid', '=', 'groep.groepid')
            ->where('leerling.leerlingid', '=', $id)
            ->select('leerling.leerlingid', 'leerling.voornaam', 'leerling.tussenvoegsel', 'leerling.achternaam', 'users.id', 'users.email', 'groep.groepid', 'groep.naam')
            ->first();

        $groepid = DB::table('groep')
            ->select('naam', 'groepid')
            ->get();


        return view('admin/aanpassen_leerling', ['leerling' => $leerling, 'groepid' => $groepid]);
    }

    public function aanpassenleerkracht(Request $request, $id)
    {
        $leerkracht = Leerkracht::where('leerkrachtid', $id)->first();
        $leerkracht->voornaam = $request->voornaam;
        $leerkracht->tussenvoegsel = $request->tussenvoegsel;
        $leerkracht->achternaam = $request->achternaam;
        $leerkracht->groepid = $request->groep;

        $leerkracht->save();

        return redirect()->route('getleerkracht')->with('succes', 'Leerkracht aangepast!');

    }

    public function aanpassenleerling(Request $request, $id)
    {
        $leerling = Leerling::where('leerlingid', $id)->first();
        $leerling->voornaam = $request->voornaam;
        $leerling->tussenvoegsel = $request->tussenvoegsel;
        $leerling->achternaam = $request->achternaam;
        $leerling->groepid = $request->groep;

        $leerling->save();

        return redirect()->route('getgroep')->with('succes', 'Leerling aangepast!');
    }

    public function aanpassenVak()
    {
        $vak = DB::table('vak')
            ->select('vakid', 'naam', 'groep')
            ->get();

        return view('admin/aanpassen_vak', ['vak' => $vak]);
    }

    public function DeleteVak($id)
    {
        DB::table('vak')
            ->where('vakid', '=', $id)
            ->delete();

        return redirect()->route('aanpassenvak')->with('succes', 'Vak verwijderd!');
    }

    public function editVak($id)
    {
        $vak = DB::table('vak')
            ->where('vakid', '=', $id)
            ->select('vakid', 'naam', 'groep')
            ->first();

        return view('admin/edit_vak', ['vak' => $vak]);
    }

    public function updateVak(Request $request, $id)
    {

        $vaknaam = DB::table('vak')
            ->where('naam', '=', $request->vaknaam)
            ->where('groep', '=', $request->groep)
            ->select('naam')
            ->first();
        if (empty($vaknaam)) {
            $vak = Vak::where('vakid', $id)->first();

            $vak->naam = $request->vaknaam;
            $vak->groep = $request->groep;

            $vak->save();

            return redirect()->route('aanpassenvak')->with('succes', 'Vak aangepast!');

        } else
            return redirect()->back()->with('error', 'Vak bestaat al!');
    }

    public function forcepasswordleerkracht($id)
    {
        $userid = DB::table('leerkracht')
            ->join('users', 'leerkracht.userid', '=', 'users.id')
            ->where('leerkracht.leerkrachtid', '=', $id)
            ->select('users.id')
            ->first();

        DB::table('users')
            ->where('id', $userid->id)
            ->update(['force_password_change' => 1]);

        DB::table('users')
            ->where('id', $userid->id)
            ->update(['password' => bcrypt('Welkom01')]);

        return redirect()->route('getleerkracht')->with('succes', 'wachtwoord gewijzigd!');

    }

    public function forcepasswordleerling($id)
    {
        $userid = DB::table('leerling')
            ->join('users', 'leerling.userid', '=', 'users.id')
            ->where('leerling.leerlingid', '=', $id)
            ->select('users.id')
            ->first();

        DB::table('users')
            ->where('id', $userid->id)
            ->update(['force_password_change' => 1]);

        DB::table('users')
            ->where('id', $userid->id)
            ->update(['password' => bcrypt('Welkom01')]);

        return redirect()->route('getgroep')->with('succes', 'wachtwoord gewijzigd!');
    }

    public function aanpassenGroep()
    {
        $groepen = DB::table('groep')
            ->select('groepid', 'naam', 'groep')
            ->orderBy('naam')
            ->get();

        return view('admin/groep_beheren', ['groepen' => $groepen]);

    }

    public function deleteGroep($id)
    {
        DB::table('groep')
            ->where('groepid', '=', $id)
            ->delete();

        return redirect()->route('aanpassengroep')->with('succes', 'Groep verwijderd!');
    }

    public function editGroep($id)
    {
        $groep = DB::table('groep')
            ->where('groepid', '=', $id)
            ->select('naam', 'groepid', 'groep')
            ->first();

        return view('admin/edit_groep', ['groep' => $groep]);
    }

    public function updateGroep(Request $request, $id)
    {
        $groepnaam = DB::table('groep')
            ->where('naam','=',$request->groepnaam)
            ->select('naam')
            ->first();
        if (empty($groepnaam)){
        $groep = Groep::where('groepid', $id)->first();

        $groep->naam = $request->groepnaam;
        $groep->groep = $request->groepjaar;

        $groep->save();

        return redirect()->route('aanpassengroep')->with('succes', 'Groep aangepast!');

    }else
        return redirect()->back()->with('error', 'Groep bestaat al!');
    }

    public function toevoegenGroep()
    {
        return view('admin/add_groep');
    }

    public function addGroep(Request $request)
    {
        $groepnaam = $request->groepnaam;


        $groepid = DB::table('groep')
            ->where('naam', '=', $groepnaam)
            ->select('groepid')
            ->first();
        if (!isset($groepid)) {

            DB::table('groep')->insert(
                ['naam' => $request->groepnaam, 'groep' => $request->groepjaar]
            );
            return redirect()->route('aanpassengroep')->with('succes', 'Groep toegevoegd!');
        } else {
            return redirect()->route('aanpassengroep')->with('error', 'Groep bestaat al!');
        }

    }

    public function changeGroep()
    {
        $groepen = DB::table('groep')
            ->select('groepid', 'naam', 'groep')
            ->orderBy('naam', 'acs')
            ->get();

        return view('admin/change_groep', ['groepen' => $groepen]);
    }

    public function overzettenGroep(Request $request)
    {

        for ($i=1; $i < count($request->oudid); $i++) {
            $request->validate(["groepnaam.$i" =>'required']);
        }

        foreach ($request->groepnaam as $key => $value) {
            DB::table('leerling')
                ->where('groepid', '=', $key)
                ->orderBy('groepid','desc')
                ->update(['groepid' => $value]);
        }

        return redirect()->route('aanpassengroep')->with('succes', 'Groepen succesvol overgezet!');
    }
}