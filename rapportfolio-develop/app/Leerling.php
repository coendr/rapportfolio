<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Leerling extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'leerlingid','voornaam','tussenvoegsel','achternaam','rapportid','groepid','portfolioid','start_datum' ,'eind_datum',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    protected $table = "leerling";

    public $timestamps = false;

    protected $primaryKey = 'leerlingid';
}

