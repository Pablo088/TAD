@extends('layouts')

@section('content')

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand mx-2">TAD</a>
        <div class="me-auto">
            <a href="{{route('student.index')}}"> <button class="btn btn-outline-info">Inicio</button></a>
            <a href="{{route('student.menu')}}"><button class="btn btn-outline-info">Menu</button></a>
            <a href="{{route('student.settings')}}"><button class="btn btn-outline-light">Configuración</button></a>
        </div>
    </nav>

    <form action="{{route('student.addSettings')}}" method="post">
        @csrf
        @method("put")

        <h3>Dias de Clase</h3>
        <input type="number" name="dias_clases">

        <h3>Promedio de Promoción</h3>
        <input type="number" name="promedio_promocion">

        <h3>Promedio de Regularidad</h3>
        <input type="number" name="promedio_regularidad">

        <h3>Edad Minima (Para entrar a la facultad)</h3>
        <input type="number" name="edad_minima">

        <button type="submit">Enviar</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success text-center">{{session('success')}}</div>
    @endif
@endsection