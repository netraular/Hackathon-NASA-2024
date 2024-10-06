<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkyViewController extends Controller
{
    public function index($view = 'exoplanets')
    {
        $exoplanets = ['exoskyV3'];
    
        // Verifica si la vista está en la lista de exoplanetas o es 'exoplanets'
        if (!in_array($view, $exoplanets) && $view !== 'exoplanets') {
            $view = 'exoplanets';
            $errorMessage = 'The selected planet does not exist.';
        } else {
            $errorMessage = null;
        }
    
        return view('skyview.layout', ['view' => $view, 'errorMessage' => $errorMessage]);
    }
}