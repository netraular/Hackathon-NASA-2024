<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkyViewController extends Controller
{

    public function exoplanets()
    {
        $csvFile = file("/var/www/html/hacknasa24/app/Scripts/translator/new_output.csv");
        $planetas = [];
        $i = -1;
        foreach ($csvFile as $line)
        {
            if ($i % 2000 == 0)
            {
                $datas = str_getcsv($line);
                $data = [
                    'id' => $i / 2000 + 1,
                    'planet_name' => $datas[0],
                    'name' => $datas[1],
                    'dist' => $datas[5],
                ];
                array_push($planetas, $data);
                // dd($planetas[0]["name"]);
            }
            $i++;
        }
        
        return view('skyview.exoplanets', ['planets' => $planetas]);
    }
    public function exoskyV3()
    {
        return view('skyview.layout', ['view' => 'exoskyV3']);
    }

    public function exoplanet($id)
    {
        $csvFile = file("/var/www/html/hacknasa24/app/Scripts/translator/new_output.csv");
        $exoplanets = range(1, 50);
        $i = -1;
        $starData = [];
        $inPlanet = false;
        if (!in_array($id, $exoplanets)) {
            return redirect('/skyview/exoplanets')->with('errorMessage', 'The selected planet does not exist.');
        }
        foreach ($csvFile as $line)
        {
            if ($i / 2000 != $id - 1 && $i / 2000 != $id && $inPlanet)
            {
                $datas2 = str_getcsv($line);
                $star = [
                    'name' => $datas2[0],
                    'x' => mt_rand(-1000000, 1000000)/5000,
                    'y' => mt_rand(-1000000, 1000000)/5000,
                    'z' => mt_rand(-1000000, 1000000)/5000,
                ];
                array_push($starData, $star);
            }
            else if ($i / 2000 == $id)
            {
                $data = [
                    'id' => $id,
                    'name' => $datas[1], // Puedes personalizar esto según tus necesidades
                    'star_name' => $datas[0],
                    'stars' => $starData,
                ];
                break ;
            }
            else if ($i / 2000 == $id - 1)
            {
                $datas = str_getcsv($line);
                $inPlanet = true;
            }
            $i++;
        }
        if ($i > 99999)
        {
            $data = [
                'id' => $id,
                'name' => $datas[1], // Puedes personalizar esto según tus necesidades
                'star_name' => $datas[0],
                'stars' => $starData,
            ];
        }
        return view('skyview.layout', ['data' => $data]);
    }
}