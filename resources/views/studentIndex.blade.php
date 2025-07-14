@extends('layouts')

@section('content')

    @section("content_header")
        <h1 class="my-3 text-center">Ingresá el DNI para encontrar el alumno</h1>
    @stop
    
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