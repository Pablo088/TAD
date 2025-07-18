@extends('layouts')

@section("head")
    @vite("resources/css/student/studentIndex.css")
@stop

@section("content_header")
    <h1 class="my-3 text-center">Marca las casillas para agregar una asistencia a los alumnos</h1>
@stop

@section('content')
    @section("content_messages")
        @if (session("error"))
        <div class="alert alert-error text-center">{{session("error")}}</div>
        @endif

        @if (session("error2"))
        <div class="alert alert-error text-center">{{session("error2")}}</div>
        @endif
    @stop
    
    <livewire:student-index-component/>

    @section("scripts")
        @livewireScripts
    @stop
@stop