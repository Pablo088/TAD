@extends('layouts')

@section('content')

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand mx-2">TAD</a>
        <div class="me-auto">
            <a href="{{route('student.index')}}"> <button class="btn btn-outline-info">Inicio</button></a>
            <a href="{{route('student.menu')}}"><button class="btn btn-outline-light">Menu</button></a>
            <a href="{{route('student.settings')}}"><button class="btn btn-outline-info">Configuración</button></a>
        </div>
    </nav>

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