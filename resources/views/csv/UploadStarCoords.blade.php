@extends('layouts.app')

@section('subtitle', 'Subir Coordenadas de Estrellas')

@section('content_body')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Upload CSV of Star Coordinates 🌟</h3> <br>
            <p>Choose a CSV file to upload with star coordinates and click below to process it!</p>
        </div>
        <div class="card-body">
            <form action="{{ route('csv.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="csv_file">Select a CSV file</label>
                    <p>Click Process CSV to see the magic happen! ✨</p>
                    <input type="file" class="form-control-file" id="csv_file" name="csv_file">
                </div>
                <button type="submit" class="btn btn-primary">Procesar CSV</button>
            </form>
            <button id="test-script-btn" class="btn btn-secondary mt-3">Ejecutar Script C#</button>
        </div>
    </div>
    <div id="script-output" class="mt-3"></div>
@stop

@section('footer')
@stop

@push('css')
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