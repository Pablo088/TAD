@extends('layouts')

@section('content')
    <h2>Condición del Alumno en Base a sus Asistencias</h2>

    @switch($assistPercentage)
        @case ($assistPercentage < 60)
            <div class="alert alert-danger text-center">Libre ({{$assistPercentage}}%)</div>
            @break
        @case($assistPercentage >=60 && $assistPercentage < 80)
            <div class="alert alert-warning text-center">Regular ({{$assistPercentage}}%)</div>
            @break
        @case($assistPercentage >=80)
            <div class="alert alert-success text-center">Promocionado ({{$assistPercentage}}%)</div>
            @break
    @endswitch
@endsection