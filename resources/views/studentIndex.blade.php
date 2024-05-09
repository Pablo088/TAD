<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Ingresá el DNI para encontrar el alumno</h1>
    <form action="{{route('student.find')}}" method="get">
        <input type="number" name="dni" placeholder="DNI Alumno">
        <button type="submit">Buscar Alumno</button>
    </form>
    @if (session("error"))
        <div>{{session("error")}}</div>
    @endif
</body>
</html>