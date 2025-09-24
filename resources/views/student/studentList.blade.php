@extends('layouts')

@section("head")
    @vite("resources/css/student/studentList.css")
@stop

@section("content_header")
    <div id="general-actions">
        <div id="general-buttons">
            <a href="{{route('student.create.general')}}"><button class="btn btn-primary">Crear</button></a>
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
                ¡Muy feliz cumpleaños, {{$cumple->name}} {{$cumple->lastName}}!
            </div>
        @endif    
    @endforeach

    <livewire:student-list-component/>
@stop