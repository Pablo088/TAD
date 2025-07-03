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
        <p>Nota1</p>
        <input type="number" name="nota1" min="1" max="10" class="form-control">
        <p>Nota2</p>
        <input type="number" name="nota2" min="1" max="10" class="form-control">
        <p>Nota3</p>
        <input type="number" name="nota3" min="1" max="10" class="form-control">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
@stop

@section("content_footer")
    <a href="{{route('student.menu')}}"><button class="btn btn-secondary">Volver</button></a>
@stop