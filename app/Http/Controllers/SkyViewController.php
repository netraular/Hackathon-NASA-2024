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
        if (!in_array($id, $exoplanets)) {
            return redirect('/skyview/exoplanets')->with('errorMessage', 'The selected planet does not exist.');
        }
        foreach ($csvFile as $line)
        {
            if ($i == -1)
            {
                $i++;
                continue;
            }
            else if ($i % 2000)
            {
                if ($i > 100)
                {
                    $data = [
                        'id' => $id,
                        'name' => $datas[1], // Puedes personalizar esto según tus necesidades
                        'star_name' => $datas[0],
                        'stars' => $starData,
                    ];
                    dump($i / 2000);
                    if ($i / 2000 == $id + 1)
                        break ;
                }
                $datas = str_getcsv($line);
                $starData = [];
            }
            else
            {
                array_push($starData, $line);
            }
            $i++;
        }
        $data = [
            'id' => $id,
            'name' => $datas[1], // Puedes personalizar esto según tus necesidades
            'star_name' => $datas[0],
            'stars' => $starData,
        ];

        return view('skyview.layout', ['view' => 'exoplanet', 'data' => $data]);
    }
}