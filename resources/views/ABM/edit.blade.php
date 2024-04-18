<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Alumno</title>
</head>
<body>
    <h1>Aca editas al alumno</h1>
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    <form action="{{route('student.update',$student)}}" method="post">
        @csrf
        @method("put")
        <input type="number" name="dni" value='{{$student->dni}}'>
        <input type="text" name="name" value="{{$student->name}}">
        <input type="text" name="lastName" value="{{$student->lastName}}">
        <input type="date" name="birthDate" value="{{$student->birthDate}}">
        <select type="text" name="group" value="{{old('group')}}">
            <option>A</option>
            <option>B</option>
        </select>
        <button type="submit">Actualizar</button>
    </form>

    <a href="{{route('student.index')}}"><button>Volver</button></a>
</body>
</html>
