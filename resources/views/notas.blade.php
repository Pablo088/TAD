@extends('layouts')

@section('content')
    <h1>Ingresa las notas del alumno</h1>
    <form action="{{route('subirNotas')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$id}}">
        <p>Nota1</p>
        <input type="number" name="nota1" min="1" max="10">
        <p>Nota2</p>
        <input type="number" name="nota2" min="1" max="10">
        <p>Nota3</p>
        <input type="number" name="nota3" min="1" max="10">
        <button type="submit">Enviar</button>
    </form>
@endsection