<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datos del Alumno</title>
</head>
<body>
    <h1>Datos del Alumno</h1>
        <table>
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Grupo</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($student as $students)
                <tr>
                    <th>{{$students->dni}}</th>
                    <th>{{$students->name}}</th>
                    <th>{{$students->lastName}}</th>
                    <th>{{$students->birthDate}}</th>
                    <th>{{$students->group}}</th>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h3>¿Querés agregarle una asistencia a este alumno?</h3>
        @foreach ($student as $students)
        <form action="{{route('student.addAssist')}}" method="post">
            @csrf
                <input type="hidden" name="id" value="{{$students->id}}">
            <button type="submit">Si</button></a>
        </form>
        @endforeach
        <a href="{{route('student.menu')}}"><button>No</button></a>
</body>
</html>