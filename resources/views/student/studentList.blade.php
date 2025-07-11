@extends('layouts')

@section("head")
    @vite("resources/css/student/studentList.css")
@stop

@section("content_header")
    <div id="general-actions">
        <div id="general-buttons">
            <a class="mx-1" href="{{route('student.new')}}"><button class="btn btn-outline-primary">Agregar Alumno</button></a>
            <a class="mx-1" href="{{route('report.pdf')}}"><button class="btn btn-outline-secondary">Reporte</button></a>
        </div>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
    
    @foreach($cumpleanios as $cumple)   
        @if($cumple)
            <div class="alert alert-success text-center">
                ¡Muy feliz cumpleaños {{$cumple->name}} {{$cumple->lastName}}!
            </div>
        @endif    
    @endforeach

    <livewire:student-list-component/>
    
    @section("scripts")
        @livewireScripts
        @vite("resources/js/student/studentList.js")
    @stop
@stop