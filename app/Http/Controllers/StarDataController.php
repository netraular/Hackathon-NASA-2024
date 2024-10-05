<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class StarDataController extends Controller
{
    public function showUploadStarsForm()
    {
        return view('csv.UploadStarCoords');
    }

    public function testScript(Request $request)
{
    // Ruta al directorio del proyecto C#
    $projectPath = '/var/www/html/hacknasa24/app/Scripts/translator';

    // Definir variables de entorno para evitar advertencias
    $env = [
        'DOTNET_CLI_HOME' => '/tmp',
        'HOME' => '/tmp',
        'XDG_DATA_HOME' => '/tmp', // Evitar el uso de /var/www/.local
    ];

    // Comando para ejecutar el script C#
    $process = new Process(['dotnet', 'run'], $projectPath, $env);
    
    // Ejecutar el script
    $process->run();

    // Verificar si el proceso se ejecutó correctamente
    if (!$process->isSuccessful()) {
        // Obtener la salida de error
        $errorOutput = $process->getErrorOutput();
        return response()->json(['output' => 'Error ejecutando el script C#: ' . $errorOutput]);
    }

    // Obtener la salida del proceso si fue exitoso
    $output = $process->getOutput();

    // Devolver la salida como respuesta JSON
    return response()->json(['output' => $output]);
}



    public function processNewStars(Request $request)
    {
        // Validar el archivo CSV
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        // Guardar el archivo CSV en el almacenamiento local
        $path = $request->file('csv_file')->store('csv');

        // Ruta al archivo CSV
        $csvFilePath = storage_path('app/' . $path);
        
        if (!file_exists($csvFilePath)) {
            return response()->json(['error' => 'Archivo CSV no encontrado en: ' . $csvFilePath], 500);
        }

        // Ejecutar el script Python
        $process = new Process(['c#', $pythonScriptPath, $csvFilePath]);
        $process->run();

        // Manejar errores
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Leer el archivo CSV de salida
        $outputCsvPath = storage_path('app/csv/output.csv');
        $outputCsvContent = file_get_contents($outputCsvPath);

        // Descargar el archivo CSV de salida
        return response($outputCsvContent)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="output.csv"');
    }
}