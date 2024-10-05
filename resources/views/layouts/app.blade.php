@extends('adminlte::page')

@section('title', config('app.name', 'Exosky!'))

@section('content_header')
    <h1>@yield('content_header_title')</h1>
@stop

@section('content')
    <div class="container">
        @yield('content_body')
    </div>
@stop

@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>
    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'Exosky!') }}
        </a>
    </strong>
@stop

@push('js')
<script>
    $(document).ready(function() {
        // Add your common script logic here...
    });
</script>
@endpush

@push('css')
<style type="text/css">
    /* You can add AdminLTE customizations here */
    /*
    .card-header {
        border-bottom: none;
    }
    .card-title {
        font-weight: 600;
    }
    */
</style>
@endpush