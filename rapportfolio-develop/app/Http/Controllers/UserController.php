<?php

namespace App\Http\Controllers;

use App\Leerling;
use App\LeerlingOuder;
use App\Ouder;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function LogIn()
    {
        return view('login');
    }

    public function PostLogIn(Request $request)
    {
        $username = $request['username'];
        $password = $request['password'];

        $id = DB::table('users')
            ->where('username', '=', $username)
            ->select('id')
            ->first();
        if ($id == null) {
            $error = "Gebruikersnaam en/of wachtwoord is onjuist!";
            return redirect()->back()->with('error', $error);
        } else {
            $force = DB::table('users')
                ->where('username', '=', $username)
                ->select('force_password_change', 'id')
                ->first();
            if ($force->force_password_change == 1) {
                return view('force_password_change', ['force' => $force]);
            } else {
                if (Auth::attempt(['username' => $username, 'password' => $password])) {

                    return redirect()->route('home');
                } else {
                    $error = "Gebruikersnaam en/of wachtwoord is onjuist!";
                    return redirect()->back()->with('error', $error);
                }
            }
        }
    }

    public
    function LogOut()
    {
        Auth::logout();
        $succes = "Je bent succesvol uitgelogd.";
        return view('login', ['succes' => $succes]);
    }

    public
    function Profile(Request $request)
    {
        $wachtwoordsucces = $request->session()->get('wachtwoordsucces');
        $wachtwoorderror = $request->session()->get('wachtwoorderror');

        if (Auth::user()->HasRole('leerling')) {
            $userid = Auth::user()->id;
            $leerling = DB::table('leerling')
                ->where('userid', '=', $userid)
                ->select('leerlingid')
                ->first();
            $ouderid = DB::table('leerling_ouder')
                ->where('leerlingid', '=', $leerling->leerlingid)
                ->select('ouderid')
                ->first();

            if (isset($ouderid)) {
                $ouderids = DB::table('leerling_ouder')
                    ->where('leerlingid', '=', $leerling->leerlingid)
                    ->select('ouderid')
                    ->get();
                foreach ($ouderids as $ouder) {
                    $naam[] = Ouder::where('ouderid', $ouder->ouderid)->select('ouderid', 'voornaam', 'tussenvoegsel', 'achternaam')->first();
                }

                return view('profile', ['naam' => $naam, 'leerling' => $leerling, 'wachtwoordsucces' => $wachtwoordsucces, 'wachtwoorderror' => $wachtwoorderror]);
            } else {
                return view('profile', ['leerling' => $leerling, 'wachtwoordsucces' =>$wachtwoordsucces, 'wachtwoorderror' => $wachtwoorderror]);
            }
        } elseif (Auth::user()->HasRole('ouder')) {
            $userid = Auth::user()->id;
            $ouderid = DB::table('ouder')
                ->where('userid', '=', $userid)
                ->select('ouderid')
                ->first();

            $leerlingid = DB::table('leerling_ouder')
                ->where('ouderid', '=', $ouderid->ouderid)
                ->select('leerlingid')
                ->first();

            if (isset($leerlingid)) {
                $leerlingids = DB::table('leerling_ouder')
                    ->where('ouderid', '=', $ouderid->ouderid)
                    ->select('leerlingid')
                    ->get();
                foreach ($leerlingids as $leerling) {
                    $naam[] = Leerling::where('leerlingid', $leerling->leerlingid)->select('leerlingid', 'voornaam', 'tussenvoegsel', 'achternaam')->first();
                }

                return view('profile', ['naam' => $naam, 'ouderid' => $ouderid, 'wachtwoordsucces' => $wachtwoordsucces, 'wachtwoorderror' => $wachtwoorderror]);

            } else {
                return view('profile', ['ouderid' => $ouderid, 'wachtwoordsucces' => $wachtwoordsucces, 'wachtwoorderror' => $wachtwoorderror]);
            }
        } else {
            return view('profile');
        }
    }

    public
    function ChangePassword(Request $request)
    {
        $oldpassword = $request['oldpassword'];
        $newpassword = $request['newpassword'];
        $password_confirmation = $request['password_confirmation'];

        if (Auth::validate(['id' => Auth::id(), 'password' => $oldpassword])) {
            if ($oldpassword == $newpassword) {
                $wachtwoorderror = 'Oud wachtwoord en nieuw wachtwoord komen overeen';
                return redirect()->route('profile')->with('wachtwoorderror', $wachtwoorderror);
            } else {

                if ($newpassword == $password_confirmation) {
                    $user = User::where('id', '=', Auth::id())->first();
                    $user->password = bcrypt($newpassword);
                    $user->save();

                    $wachtwoordsucces = 'Wachtwoord is gewijzigd!';
                    return redirect()->route('profile')->with('wachtwoordsucces', $wachtwoordsucces);
                } else {
                    $wachtwoorderror = 'Nieuw wachtwoord en herhaal nieuw wachtwoord komen niet overeen';
                    return redirect()->route('profile')->with('wachtwoorderror', $wachtwoorderror);
                }
            }
        } else {
            $wachtwoorderror = 'Oud wachtwoord klopt niet';
            return redirect()->route('profile')->with('wachtwoorderror', $wachtwoorderror);
        }
    }

    public
    function Leerlinglink(Request $request)
    {
        $leerling = DB::table('leerling')
            ->where('leerlingid', '=', $request->leerlinglink)
            ->select('leerlingid')
            ->first();

        if (!empty($leerling)) {
            $id = Auth::user()->id;
            $ouderid = DB::table('ouder')
                ->where('userid', '=', $id)
                ->select('ouderid')
                ->first();

            $groepid = DB::table('leerling')
                ->where('leerlingid', '=', $request->leerlinglink)
                ->select('groepid')
                ->first();

            $check = DB::table('leerling_ouder')
                ->where('ouderid', '=', $ouderid->ouderid)
                ->where('leerlingid', '=', $request->leerlinglink)
                ->select('leerling_ouderid')
                ->first();

            if ($check === null) {
                DB::table('leerling_ouder_pending')
                    ->insert(['ouderid' => $ouderid->ouderid, 'leerlingid' => $request->leerlinglink, 'groepid' => $groepid->groepid]);

                return redirect()->back()->with('succes', 'De link is doorgestuurd naar de leerkracht van het kind om goedkeuring te bevestigen');
            } else {
                return redirect()->back()->with('error', 'U bent al gelinkt met dit kind!');
            }
        } else {
            return redirect()->back()->with('error', 'De door u ingevulde code bestaat niet!');
        }
    }

    public function PendingLink(Request $request)
    {
        $succes = $request->session()->get('succes');
        $error = $request->session()->get('error');
        $userid = Auth::user()->id;
        $leerkracht = DB::table('leerkracht')
            ->where('userid', '=', $userid)
            ->select('groepid')
            ->first();

        $links = DB::table('leerling_ouder_pending')
            ->where('groepid', '=', $leerkracht->groepid)
            ->select('leerling_ouder_pendingid', 'leerlingid', 'ouderid')
            ->get();

        foreach ($links as $l) {
            $l->leerlingid = Leerling::where('leerlingid', $l->leerlingid)->select('leerlingid', 'voornaam', 'tussenvoegsel', 'achternaam')->first();

        }

        foreach ($links as $l) {
            $l->ouderid = Ouder::where('ouderid', $l->ouderid)->select('ouderid', 'voornaam', 'tussenvoegsel', 'achternaam')->first();
        }

        return view('link_bevestigen', ['links' => $links, 'succes' => $succes, 'error' => $error]);
    }

    public function acceptLink($id)
    {


        if (Auth::user()->leerkracht) {
            $link = DB::table('leerling_ouder_pending')
                ->where('groepid', '=', Auth::user()->leerkracht->groepid)
                ->select('leerling_ouder_pendingid', 'leerlingid', 'ouderid');

            $oldlink = $link->first();

            $checkaccepted = LeerlingOuder::where('leerlingid', $oldlink->leerlingid)->where('ouderid', $oldlink->ouderid)->first();

            if (!$checkaccepted) {
                $leerlingouder = new LeerlingOuder();
                $leerlingouder->leerlingid = $oldlink->leerlingid;
                $leerlingouder->ouderid = $oldlink->ouderid;
                $leerlingouder->save();

                $link->delete();
            }

            $succes = "Leerling-ouder zijn succesvol gekoppeld";
            return redirect()->route('pending')->with('succes', $succes );
        }
        abort(404);

    }

    public function rejectLink($id){

        if (Auth::user()->leerkracht) {
            $link = DB::table('leerling_ouder_pending')
                ->where('groepid', '=', Auth::user()->leerkracht->groepid)
                ->select('leerling_ouder_pendingid', 'leerlingid', 'ouderid');

            $link->delete();

            $error = "Leerling-ouder zijn niet gekoppeld";
            return redirect()->route('pending')->with('error', $error );
        }
        abort(404);


    }

    public
    function Deletelink($id)
    {
        $userid = Auth::user()->id;
        $leerlingid = DB::table('leerling')
            ->where('userid', '=', $userid)
            ->select('leerlingid')
            ->first();

        DB::table('leerling_ouder')
            ->where('leerlingid', '=', $leerlingid->leerlingid)
            ->where('ouderid', '=', $id)
            ->delete();

        return redirect()->back()->with('succes', "De ouder of verzorger is uit jouw lijst verwijderd");
    }

    public function Deleteouderlink($id)

    {
        $userid = Auth::user()->id;
        $ouderid = DB::table('ouder')
            ->where('userid', '=', $userid)
            ->select('ouderid')
            ->first();
        DB::table('leerling_ouder')
            ->where('ouderid', '=', $ouderid->ouderid)
            ->where('leerlingid', '=', $id)
            ->delete();

        return redirect()->back()->with('succes', "De leerling is uit uw lijst verwijderd");
    }

    public
    function ForcePasswordChange(Request $request, $id)
    {
        $password = $request['password'];
        $repassword = $request['repassword'];

        if ($password == $repassword) {
            $user = User::where('id', $id)->first();
            $user->password = bcrypt($password);
            $user->force_password_change = 0;
            $user->save();

            $succes = 'Wachtwoord is gewijzigd!';
            return view('login', ['succes' => $succes]);
        } else {
            $error = 'Wachtwoord en wachtwoord opnieuw komen niet overeen';
            return view('login', ['error' => $error]);
        }

    }
}