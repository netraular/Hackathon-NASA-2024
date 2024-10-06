<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkyViewController extends Controller
{
    public function index($view = 'exoplanets')
    {
        // Verifica si la vista existe
        if (!view()->exists("skyview.{$view}")) {
            $view = 'exoplanets';
            $errorMessage = 'The selected planet does not exist.';
        } else {
            $errorMessage = null;
        }

        return view('skyview.layout', ['view' => $view, 'errorMessage' => $errorMessage]);
    }
}