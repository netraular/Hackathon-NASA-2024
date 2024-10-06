<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkyViewController extends Controller
{

    public function exoplanets()
    {
        $data = [
            'id' => 1,
        ];
        return view('skyview.layout', ['view' => 'exoplanets', 'data' => 'data']);
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
                array_push($starData, $line);
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
        }

        return view('skyview.layout', ['view' => 'exoplanet', 'data' => $data]);
    }
}