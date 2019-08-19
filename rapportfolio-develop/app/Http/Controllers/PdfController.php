<?php

namespace App\Http\Controllers;

use App;
use App\Rapport;
use App\Leerling;
use App\Reflectie;
use PDF;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function pdfview1($id, $jaar)
    {
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
            ->get();

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

        $pdf = PDF::loadView('pdf.rapport1', ['cijfer' => $cijfer, 'cijfer1' => $cijfer1, 'leerling' => $leerling, 'notitie1' => $notitie1, 'zelfknap1' => $zelfknap1, 'mensknap1' => $mensknap1, 'werkknap1' => $werkknap1, 'check1' => $check1]);
        return $pdf->stream('pdf_rapport1');
    }

    public function pdfview2($id, $jaar)
    {
        $leerling = DB::table('leerling')
            ->where(['leerlingid' => $id])
            ->select('voornaam', 'tussenvoegsel', 'achternaam', 'leerlingid')
            ->first();

        $rid2 = DB::table('rapport')
            ->where(['leerlingid' => $id])
            ->where(['jaar' => $jaar])
            ->where(['naam' => 'rapport 2'])
            ->select('rapportid')
            ->first();

        $cijfer2 = DB::table('beoordeling')
            ->join('vak', 'beoordeling.vakid', '=', 'vak.vakid')
            ->where('beoordeling.rapportid', '=', $rid2->rapportid)
            ->select('beoordeling.cijfer', 'vak.naam')
            ->get();

        $notitie2 = DB::table('rapport')
            ->where(['leerlingid' => $id])
            ->where(['jaar' => $jaar])
            ->where(['naam' => 'rapport 2'])
            ->select('notitie', 'notitie_leerling')
            ->first();

        $check2 = DB::table('reflectie')
            ->where('rapportid', '=', $rid2->rapportid)
            ->where('knapid', '=', 1)
            ->select('kind')
            ->first();

        $check3 = DB::table('beoordeling')
            ->where('rapportid', '=', $rid2->rapportid)
            ->select('cijfer')
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

        $pdf = PDF::loadView('pdf.rapport2', ['cijfer2' => $cijfer2, 'leerling' => $leerling, 'notitie2' => $notitie2, 'zelfknap2' => $zelfknap2, 'mensknap2' => $mensknap2, 'werkknap2' => $werkknap2, 'check2' => $check2, 'check3' => $check3]);
        return $pdf->stream('pdf_rapport2');
    }
}