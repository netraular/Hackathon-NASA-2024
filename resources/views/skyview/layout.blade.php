<!-- /var/www/html/hacknasa24/resources/views/skyview/layout.blade.php -->

@extends('layouts.app')

@section('subtitle', 'Star Field')

@section('content_body')
    @include("skyview.{$view}")

    @if(session('errorMessage'))
        <script>
            alert("{{ session('errorMessage') }}");
        </script>
    @endif
@stop

@section('footer')
    <div class="custom-footer">
        <div class="float-right">
            Version: {{ config('app.version', '1.0.0') }}
        </div>
        <strong>
            <a href="{{ config('app.company_url', '#') }}">
                Button :)
            </a>
        </strong>
    </div>
@stop

@push('css')
    <style>
        body, html {
            height: 100%;
            overflow: hidden; /* Elimina el scroll vertical */
        }
        canvas { display: block; }
        #info {
            position: absolute;
            color: white;
            font-family: Arial, sans-serif;
            z-index: 1;
            top: 50px; /* Ajusta esta propiedad para mover el texto hacia arriba */
            left:calc(50vw - 400px);
            white-space: nowrap; /* Evita que el texto se divida en varias líneas */
            text-align: center;
        }

        #threejs-container {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden; /* Asegura que no haya desplazamientos adicionales */
        }
        .content-wrapper {
            height: calc(100vh);
            overflow: hidden;
            padding: 0 !important;
        }
        .content{
            margin: 0 !important;
            padding: 0 !important;
        }
        .container-fluid{
            margin: 0 !important;
            padding: 0 !important;
        }
        .container{
            margin: 0 !important;
            padding: 0 !important;
        }
        .content-header{
            padding: 0 !important;
        }
        .main-footer{
            margin: 0 !important;
            padding: 0 !important;
        }
        .custom-footer {
            margin: 0 !important;
            padding: 0 !important;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo transparente */
            color: white;
            text-align: center;
            padding: 10px 0;
            z-index: 2; /* Asegura que esté encima del contenido */
        }
        .custom-footer a {
            color: white;
            text-decoration: none;
        }
        .main-header.navbar {
            padding: 0 !important;
            border: none !important;
            background-color: rgba(69,77,85, 0); /* Fondo transparente al 50% */
            position: absolute;
            top: 0;
            left: 0;
            z-index: 3; /* Asegura que esté encima del contenido */
        }
        .main-header a {
            color: white;
            text-decoration: none;
        }

        #star-info {
            display: none;
            position: absolute;
            color: white;
            font-family: Arial, sans-serif;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 5px;
            border-radius: 5px;
            pointer-events: none; /* Asegura que el elemento no interfiera con los clics */
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function adjustHeaderWidth() {
                const contentWrapper = document.querySelector('.content-wrapper');
                const mainHeader = document.querySelector('.main-header.navbar');
                const contentBody = document.querySelector('.content-wrapper .content');
                if (contentWrapper && mainHeader && contentBody) {
                    const contentWidth = contentWrapper.offsetWidth;
                    mainHeader.style.width = contentWidth + 'px';
                    contentBody.style.width = contentWidth + 'px';
                }
            }

            // Ajustar el ancho inicialmente
            adjustHeaderWidth();

            // Ajustar el ancho cuando se redimensiona la ventana
            window.addEventListener('resize', adjustHeaderWidth);

            // Ajustar el ancho cuando se colapsa o se expande el sidebar
            const sidebar = document.querySelector('.main-sidebar');
            if (sidebar) {
                sidebar.addEventListener('transitionend', adjustHeaderWidth);
            }
        });
    </script>
@endpush