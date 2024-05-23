
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
</head>
<script>
            function confirmar(){
                let respuesta = confirm("¿Queres borrrar este registro?");
                if(respuesta == true){
                    return true;
                } else{
                    return false;
                }
            }
</script>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand mx-2">TAD</a>
        <div class="me-auto">
            <a href="{{route('student.index')}}"> <button class="btn btn-outline-info">Inicio</button></a>
            <a href="{{route('student.menu')}}"><button class="btn btn-outline-light">Menu</button></a>
            <a href="{{route('student.settings')}}"><button class="btn btn-outline-info">Configuración</button></a>
        </div>
    </nav>

        <a href="{{route('student.index')}}"><button>Volver al Indice</button></a> 
        <a href="{{route('student.new')}}"><button>Agregar Alumno</button></a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @foreach($cumpleanios as $cumple)   
            @if($cumple)
                <div>
                    ¡Muy feliz cumpleaños {{$cumple->name}} {{$cumple->lastName}}!
                </div>
            @endif    
        @endforeach
        <div>
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
                @foreach($student as $students)
                    <tr>
                        <th>{{$students->dni}}</th>
                        <th>{{$students->name}}</th>
                        <th>{{$students->lastName}}</th>
                        <th>{{$students->birthDate}}</th>
                        <th>{{$students->group}}</th>
                        <th><a href="{{route('student.edit',$students->id)}}"><button>Modificar</button></a></th>
                        <th>
                        <form action="{{route('student.destroy',$students->id)}}" method="post">
                            @csrf  
                            @method("delete")
                            <button type="submit" id="botonEliminar" onclick="return confirmar()">Eliminar</button>
                        </form>
                        </th>
                        <th>
                            <a href="{{route('student.assistList',$students->id)}}"><button>Cantidad de Asistencias</button></a>
                        </th>
                        <th>
                            <a href="{{route('student.condition',$students->id)}}"><button>Condicion</button></a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
</body>
</html>
