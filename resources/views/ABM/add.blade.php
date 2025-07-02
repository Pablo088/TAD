@extends('layouts')

@section("head")
    @vite("resources/css/student/abm/add.css")
@stop

@section('content')
    @section("content_header")
        <h1>Alta de alumno</h1>
    @stop

    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    
    <form action="{{route('student.add')}}" method="post" id="add-form">
        @csrf

        <div class="campo-container">
            <label for="dni">DNI</label>
            <input type="number" name="dni" id="dni" class="form-control" placeholder="DNI" value="{{old('dni')}}">
        </div>

        <div class="campo-container">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" value="{{old('name')}}">
        </div>

        <div class="campo-container">
            <label for="lastName">Apellido</label>
            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Apellido" value="{{old('lastName')}}">
        </div>

        <div class="campo-container">
            <label for="birthDate">Fecha de Nacimiento</label>
            <input type="date" name="birthDate" id="birthDate" class="form-control" value="{{old('birthDate')}}">
        </div>

        <div class="campo-container">
            <label for="year">Año</label>
            <select type="number" name="year" id="year" class="form-control" value="{{old('year')}}">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
            </select>
        </div>

        <div class="campo-container">
            <label for="division">Division</label>
            <select type="text" name="division" id="division" class="form-control" value="{{old('division')}}">
                <option>A</option>
                <option>B</option>
            </select>
        </div>
        
        <div class="campo-container">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
    
    <footer id="btn-volver">
        <a href="{{route('student.menu')}}"><button class="btn btn-secondary">Volver</button></a>
    </footer>
@endsection