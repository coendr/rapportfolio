<?php

namespace App\Http\Controllers;

use App\Ouder;
use App\User;
use DB;
use Illuminate\Http\Request;

class RegistratieController extends Controller
{
    public function create()
    {
        return view('registreren');
    }

    public function store(request $request)
    {
        $username = DB::table('users')
            ->where('username', '=', $request->username)
            ->select('username')
            ->first();
        if (isset($username)) {
            return redirect()->back()->with('error', "Gebruikersnaam bestaat al!");
        } else {
            if ($request->password == $request->repassword) {


                $user = new User();
                $ouder = new Ouder();

                $user->username = $request->username;
                $user->password = bcrypt($request->password);
                $user->role = "ouder";
                $user->force_password_change = 0;
                $user->save();

                $lastInsertedId = $user->id;

                $ouder->userid = $lastInsertedId;
                $ouder->voornaam = $request->voornaam;
                $ouder->tussenvoegsel = $request->tussenvoegsel;
                $ouder->achternaam = $request->achternaam;
                $ouder->save();

                $succes = "Account geregistreerd!";
                return redirect('login')->with('succes','Account geregistreerd!');

            } else {
                return back()->with('error', 'Wachtwoorden komen niet overeen!');
            }
        }
    }
}
