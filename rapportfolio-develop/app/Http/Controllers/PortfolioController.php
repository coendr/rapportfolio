<?php

namespace App\Http\Controllers;

use App;
use App\Portfolio;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Validator;

class PortfolioController extends Controller
{
    public function InvullenNamen()
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

        return view('portfolio/invullen_namen', ['leerlingen' => $leerlingen]);
    }

    public function fileExtension($file_name)
    {
        return substr(strrchr($file_name, '.'), 1);
    }

    public function PortfolioInvoegen($id)
    {
        return view('portfolio/invoegen', ['id' => $id]);
    }

    public function PortfolioUploaden($id, Request $request)
    {
        $this->validate($request, [

            'file' => 'required|mimes:jpg,png,jpeg,gif,svg,pdf|max:15000'], ['mimes' => 'Bestand moet een jpg,png,jpeg,svg of pdf zijn.']
        );

        $ext = $this->fileExtension($request->oke);
        $ext = strtolower($ext);

        if ($request->hasFile('file')) {
            $naam = $request->uploadnaam;
            $path = $request->file->getClientOriginalName();
            $request->file->storeAs('public/img', $path);

            $upload = new portfolio;
            $upload->leerlingid = $id;
            $upload->naam = $naam;
            $upload->path = $path;
            $upload->timestamps = false;
            $upload->save();

            if ($ext == "png" || $ext == " jpg" || $ext == "jpeg") {
                $succes = "Foto is succesvol geupload!";
            } else {
                $succes = "Bestand is succesvol geupload!";
            }
            return view('portfolio/invoegen', ['id' => $id, 'succes' => $succes]);
        }
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

        return view('portfolio/bekijken_kiezen', ['leerlingen' => $leerlingen]);
    }

    public function GetPortfolio($id)
    {
        $portfolio = DB::table('portfolio')
            ->where('leerlingid', '=', $id)
            ->select('naam', 'path', 'portfolioid')
            ->get();

        $naam = DB::table('leerling')
            ->where('leerlingid', '=', $id)
            ->select('voornaam', 'tussenvoegsel', 'achternaam')
            ->first();

        return view('portfolio/bekijken', ['portfolio' => $portfolio, 'naam' => $naam]);
    }

    public function OudersPortfolio()
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

        return view('portfolio/bekijken_kiezen', ['leerlingen' => $leerlingen]);
    }

    public function LeerlingPortfolio()
    {
        $userid = Auth::user()->id;
        $leerlingid = DB::table('leerling')
            ->where('userid', '=', $userid)
            ->select('leerlingid')
            ->first();

        $naam = DB::table('leerling')
            ->where('leerlingid', '=', $leerlingid->leerlingid)
            ->select('voornaam', 'tussenvoegsel', 'achternaam')
            ->first();

        $portfolio = DB::table('portfolio')
            ->where('leerlingid', '=', $leerlingid->leerlingid)
            ->select('naam', 'path')
            ->get();

        return view('portfolio/bekijken', ['portfolio' => $portfolio, 'naam' => $naam]);

    }

    public function DeletePortfolio($id)
    {
        $file = DB::table('portfolio')
            ->where('portfolioid', '=', $id)
            ->select('path')
            ->first();
        
        $ext = $this->fileExtension($file->path);
        $ext = strtolower($ext);

        $rapportfolio = DB::table('portfolio')
            ->where('portfolioid', '=', $id);
        $rapportfolio->delete();

        if ($ext == "png" || $ext == " jpg" || $ext == "jpeg") {
            return redirect()->back()->with('succes', 'Foto is verwijderd!');
        } else {
            return redirect()->back()->with('succes', 'Bestand is verwijderd!');
        }

    }
}