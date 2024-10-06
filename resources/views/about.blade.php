@extends('layouts.app')

@section('subtitle', 'Welcome page')

@section('content_body')

<div class="container text-center" style="margin-top: 20px;">
    <h4 style="color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 3em;">🌌 Project Name 🚀</h4>
</div>

<div class="container" style="margin-top: 20px; color: #e0e0e0; font-family: 'Poppins', sans-serif; font-size: 1.2em;">
    <p style="text-align: justify;">This project, part of the NASA 2024 Hackathon, is about imagining what the night sky would look like from different exoplanets. The interactive website lets users explore the stars from 50 exoplanets and access scientific information about them. 🌠 Users can also create their own constellations, name them, and save them, allowing others to see and interact with these new designs. By turning complex data into something creative and interactive, this project helps make distant worlds more relatable, inspiring curiosity and imagination. Beyond the fun, it’s about connecting students and young people with space, fostering a sense of wonder about the universe and sparking interest in science and astronomy. ✨</p>

    <p style="text-align: justify;">👨‍💻👩‍💻 We are a team of six young people, aged 21 to 25, from both Spain and Italy, each with different educational backgrounds. Together, we bring diverse skills and perspectives to the project. 💫 Our project aims to make an educational impact by bridging the gap between complex scientific data and young minds, promoting creativity and learning through technology and space exploration.</p>

    <p style="text-align: justify;">💻 Github: <a href="https://github.com/netraular/Hackathon-NASA-2024" target="_blank">https://github.com/netraular/Hackathon-NASA-2024</a></p>

    <p style="text-align: justify;">💌 Contact Emails:</p>
    <div style="text-align: center;">
        <ul style="list-style-type: none; padding-left: 0; color: #e0e0e0;">
            <li style="margin-bottom: 5px;">bielbag21@gmail.com</li>
            <li style="margin-bottom: 5px;">zsolt.palfi02@gmail.com</li>
            <li style="margin-bottom: 5px;">netraular@gmail.com</li>
            <li style="margin-bottom: 5px;">nagobcn@gmail.com</li>
            <li style="margin-bottom: 5px;">matilde.sartori3@gmail.com</li>
            <li style="margin-bottom: 5px;">oayat091@gmail.com</li>
        </ul>
    </div>
</div>

@stop

@section('footer')
<div style="text-align: center; margin: 0;">
    <h5 style="color: #ff7e00; font-family: 'Poppins', sans-serif; font-weight: bold; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);">🌌 Explore the Universe with Us!</h5>
    <p style="text-align: center;"> 🚀 Join our mission to inspire future astronomers and space explorers!</p>
</div>
@stop

@push('css')
<style>
    /* public/css/app.css */
    body {
        background: linear-gradient(to bottom, #000000, #4b0082); /* Degradado de negro a lila oscuro */
        color: #ffffff; /* Color de texto para que sea legible */
        margin: 0; /* Eliminar márgenes predeterminados */
        padding: 0; /* Eliminar padding predeterminados */
        font-family: 'Poppins', sans-serif; /* Fuente más estilizada */
    }

    .content-wrapper {
        background-color: transparent; /* Mantener el fondo transparente */
    }

    /* Estilo para el menú desplegable */
    .sidebar {
        text-align: left; /* Alineación a la izquierda del menú */
    }

    .sidebar ul {
        list-style-type: none; /* Eliminar puntos de lista */
        padding-left: 0; /* Sin sangría a la izquierda */
    }

    .sidebar ul li {
        text-align: left; /* Justificar a la izquierda cada pestaña del menú */
        margin-bottom: 10px; /* Espacio entre los elementos del menú */
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
        text-align: justify; /* Justificar todo el texto del body */
    }

    ul {
        padding-left: 0; /* Eliminar padding izquierdo */
        list-style-type: none; /* Eliminar puntos de lista */
    }

    li {
        margin-bottom: 5px; /* Espacio entre elementos de lista */
        text-align: center; /* Centrando el texto de los correos */
    }

    /* Footer styles */
    h5 {
        margin: 0; /* Sin márgenes para el título */
        padding: 10px 0; /* Padding arriba y abajo */
    }

    p {
        margin: 0; /* Sin margen adicional en el párrafo */
        padding: 5px 20px; /* Espacio a los lados para mejor lectura */
        text-align: center; /* Centrar texto en el footer */
    }
</style>
@endpush




