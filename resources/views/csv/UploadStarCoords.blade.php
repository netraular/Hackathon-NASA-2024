@extends('layouts.app')

@section('subtitle', 'Upload Exoplanet and Star Coordinates')

@section('content_body')

<div class="container text-center" style="margin-top: 20px;">
    <h4 style="color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 2.5em;">🌟 Upload Coordinates of Exoplanets and Stars 🌍</h4> <!-- Título en inglés con emoticonos y fuente ajustada -->
</div>

<div class="container" style="margin-top: 20px; text-align: justify; color: #e0e0e0; font-family: 'Poppins', sans-serif; font-size: 1.2em;">
    <!-- Sección de carga de archivo CSV -->
    <div class="container-fluid" style="padding: 20px; text-align: center; position: relative; overflow: hidden; margin: 0;"> <!-- Sin márgenes ni paddings -->
        <div class="card" style="background-color: #1a2530; color: white; border: none; padding: 20px; border-radius: 8px;"> <!-- Eliminar la línea negra -->
            <h3 class="card-title" style=" font-size: 2rem; color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: bold;">
                Upload CSV of Star Coordinates 🌟
            </h3>
            <div class="card-header">
                <br>
                <p style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; color: #e0e0e0;">
                    Choose a CSV file to upload with star coordinates and click below to process it!
                </p>
                <p style="font-size: 1.5rem; font-family: 'Poppins', sans-serif; color: #e0e0e0; margin-top: 20px;">
                    Example of CSV file to upload:
                </p>
                <img src="{{ asset('images/output ex.png') }}" alt="Example CSV file" style="max-width: 100%; height: auto; margin-top: 10px;">
            </div>
            <div class="card-body">
                <form action="{{ route('csv.process') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="csv_file" style="font-family: 'Poppins', sans-serif; color: #e0e0e0;"> 1- Select a CSV file </label>
                        <br> <!-- Traducción del texto -->
                        <label style="font-family: 'Poppins', sans-serif; color: #e0e0e0;">
                            2- Click "Process CSV" to see the magic happen! ✨ <!-- Traducción del texto -->
                        </label>
                        <br>
                        <input type="file" class="form-control-file" id="csv_file" name="csv_file">
                    </div>
                    <button type="submit" class="btn btn-primary" style="font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 1.2em; padding: 15px 30px;">Process CSV</button> <!-- Botón en inglés -->
                </form>
            </div>
        </div>
    </div>

    <div id="script-output" class="mt-3" style="text-align: center; color: #e0e0e0;"></div>
</div>

@stop

@section('footer')
<div style="text-align: center; margin: 0;"> <!-- Centrado y sin margen -->
    <h5 style="color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: bold;">
        🌌 Explore the Universe with Us!
    </h5>
    <p style="text-align: center;"> <!-- Justificado -->
        🚀 Join our mission to inspire future astronomers and space explorers!
    </p>
</div>
@stop

@push('css')
<style>
    /* Estilos adicionales para el fondo y el color del texto */
    body {
        background: linear-gradient(to bottom, #000000, #4B0082); /* Degradado de negro a morado */
        color: white; /* Color de texto para que sea legible */
        margin: 0; /* Eliminar márgenes predeterminados */
        padding: 0; /* Eliminar padding predeterminados */
        font-family: 'Poppins', sans-serif; /* Fuente más estilizada */
    }

    .content-wrapper {
        background-color: transparent; /* Mantener el fondo transparente */
    }

    .main-footer {
        background-color: #343a40; /* Color de fondo oscuro */
        color: #ffffff; /* Color de texto para que sea legible */
    }

    h4 {
        margin: 20px 0; /* Espacio arriba y abajo del título */
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); /* Sombra del texto */
    }

    p {
        margin-bottom: 20px; /* Espacio inferior entre párrafos */
        line-height: 1.6; /* Mayor espacio entre líneas */
    }
</style>
@endpush

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#test-script-btn').click(function() {
            $.ajax({
                url: "{{ route('test.script') }}", // Usamos solo route() porque el APP_URL debe estar bien configurado
                type: 'GET',
                success: function(response) {
                    $('#script-output').html('<pre>' + response.output + '</pre>');
                },
                error: function(xhr, status, error) {
                    $('#script-output').html('<pre>Error al ejecutar el script: ' + error + '</pre>');
                }
            });
        });
    });
</script>
@endpush
