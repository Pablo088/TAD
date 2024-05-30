@extends('layouts')

@section('content')

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand mx-2">TAD</a>
        <div class="me-auto">
            <a href="{{route('student.index')}}"> <button class="btn btn-outline-light">Inicio</button></a>
            <a href="{{route('student.menu')}}"><button class="btn btn-outline-info">Menu</button></a>
            <a href="{{route('student.settings')}}"><button class="btn btn-outline-info">Configuración</button></a>
        </div>
    </nav>
    <h1 class="my-3 text-center">Ingresá el DNI para encontrar el alumno</h1>
    <form class="d-flex justify-content-center" action="{{route('student.find')}}" method="get">
        <input class="form-control-lg text-center my-3" type="number" name="dni" placeholder="DNI Alumno">
    </form>
    @if (session("error"))
        <div class="alert alert-error text-center">{{session("error")}}</div>
    @endif

    @if (session("error2"))
        <div class="alert alert-error text-center">{{session("error2")}}</div>
    @endif
    
    @endsection