<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand mx-2">TAD</a>
        <div class="me-auto">
            <a href="{{route('student.index')}}"> <button class="btn btn-outline-info">Inicio</button></a>
            <a href="{{route('student.menu')}}"><button class="btn btn-outline-light">Menu</button></a>
            <a href="{{route('student.settings')}}"><button class="btn btn-outline-info">Configuración</button></a>
        </div>
    </nav>
    <h1>Ingresá el DNI para encontrar el alumno</h1>
    <form action="{{route('student.find')}}" method="get">
        <input type="number" name="dni" placeholder="DNI Alumno">
        <button type="submit">Buscar Alumno</button>
    </form>
    @if (session("error"))
        <div>{{session("error")}}</div>
    @endif

    @if (session("error2"))
        <div>{{session("error2")}}</div>
    @endif
</body>
</html>