@extends('layouts')

@section("head")
    @vite("resources/css/student/notas.css")
@stop

@section("content_header")
    <h1>Ingresa las notas del alumno</h1>
@stop

@section('content')
    <form action="{{route('subirNotas')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$id}}" class="form-control">
       
        <div class="campo-container">
            <label for="">Nombre Parcial</label>
            <input type="text" name="nombreParcial" maxlength="32" class="form-control">
        </div>

        <div class="campo-container">
            <label for="">Nota</label>
            <input type="number" name="nota" min="1" max="10" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
@stop

@section("content_footer")
    <a href="{{route('student.list')}}"><button class="btn btn-secondary">Volver</button></a>
@stop