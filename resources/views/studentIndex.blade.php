@extends('layouts')

@section("head")
    @vite("resources/css/student/studentList.css")
@stop

@section("content_header")
    <h1 class="my-3 text-center">Ingresá el DNI para encontrar el alumno</h1>
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