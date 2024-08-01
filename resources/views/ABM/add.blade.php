@extends('layouts')

@section('content')
    <h1>Ingresa los datos del alumno que quieras agregar</h1>
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    <form action="{{route('student.add')}}" method="post">
        @csrf
        <input type="number" name="dni" placeholder="DNI" value="{{old('dni')}}">
        <input type="text" name="name" placeholder="Nombre" value="{{old('name')}}">
        <input type="text" name="lastName" placeholder="Apellido" value="{{old('lastName')}}">
        <input type="date" name="birthDate" value="{{old('birthDate')}}">
        <select type="number" name="year" value="{{old('year')}}">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
        </select>
        <select type="text" name="division" value="{{old('division')}}">
            <option>A</option>
            <option>B</option>
        </select>
        <button type="submit">Agregar</button>
    </form>
    <a href="{{route('student.menu')}}"><button>Volver</button></a>
</body>
</html>

@endsection