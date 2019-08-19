<?php

namespace App;

use DB;
use Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'email' ,'role' ,'force_password_change'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function leerkracht(){
        return $this->hasOne('App\Leerkracht', 'userid', 'id');
    }

    public static function getLeerlingnaam(){
        $leerling = Leerling::where('userid', Auth::id())->first();
        if($leerling->tussenvoegsel) {
            $leerling->tussenvoegsel = $leerling->tussenvoegsel.' ';
        }else{
            $leerling->tussenvoegsel = NULL;
        }

        $leerling = $leerling->voornaam.' '.$leerling->tussenvoegsel.''.$leerling->achternaam;
        return $leerling;
    }

    public static function getLeerkrachtnaam(){
        $leerkracht = Leerkracht::where('userid', Auth::id())->first();
        if($leerkracht->tussenvoegsel) {
            $leerkracht->tussenvoegsel = $leerkracht->tussenvoegsel.' ';
        }else{
            $leerkracht->tussenvoegsel = NULL;
        }

        $leerkracht = $leerkracht->voornaam.' '.$leerkracht->tussenvoegsel.''.$leerkracht->achternaam;

        return $leerkracht;
    }

    public static function getLeerkrachtgroep(){
        $groep = Leerkracht::where('userid', Auth::id())->first();

        $groepnaam = DB::table('groep')
            ->where('groepid','=', $groep->groepid)
            ->select('groep')
            ->first();
        $groep = $groepnaam->groep;

        return $groep;
    }

    public static function getOudernaam(){
        $ouder = Ouder::where('userid', Auth::id())->first();
        if($ouder->tussenvoegsel) {
            $ouder->tussenvoegsel = $ouder->tussenvoegsel.' ';
        }else{
            $ouder->tussenvoegsel = NULL;
        }

        $ouder = $ouder->voornaam.' '.$ouder->tussenvoegsel.''.$ouder->achternaam;

        return $ouder;
    }

    public static function getAdminnaam(){
        $admin = Admin::where('userid', Auth::id())->first();

        $admin = $admin->naam;

        return $admin;
    }



    public static function getRole(){
        $user = User::where('id' ,'=', Auth::id())->first();
        return $user->role;

    }
    public static function hasRole($role){
        return $user = User::where([
            ['role', '=', $role],
            ['id', '=', Auth::id()]
        ])->first();
    }

    public function CheckNieuweRapportenOuder()
    {
        $notificatie = 0;
        $sql = 0;

        $ouder = DB::table('ouder')
            ->where('userid', '=', Auth::id())
            ->select('ouderid')
            ->first();

        $leerlingen = DB::table('leerling_ouder')
            ->join('leerling', 'leerling.leerlingid', '=', 'leerling_ouder.leerlingid')
            ->where('leerling_ouder.ouderid', '=', $ouder->ouderid)
            ->select('leerling.leerlingid')
            ->get();

        foreach ($leerlingen as $leerling) {
        $sql = DB::table('rapport')
            ->where('leerlingid', '=', $leerling->leerlingid)
            ->where('ouder_bekeken', '=', '0')
            ->count();
        }

        if ($sql == 0){
            return 0;
        }

        else
        {
            return $sql;

        }

    }

    public $timestamps = false;
}
