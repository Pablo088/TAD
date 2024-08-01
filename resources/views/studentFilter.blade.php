@extends('layouts')

@section('content')

<nav class="navbar navbar-dark bg-dark mb-3">
        <a class="navbar-brand mx-2">TAD</a>
        <div class="me-auto">
            <a href="{{route('student.index')}}"> <button class="btn btn-outline-info">Inicio</button></a>
            <a href="{{route('student.menu')}}"><button class="btn btn-outline-light">Menu</button></a>
            <a href="{{route('student.settings')}}"><button class="btn btn-outline-info">Configuración</button></a>
        </div>
</nav>

    <form id="form" class="mb-3 d-flex justify-content-center" action="{{route('student.filter')}}" method="get">
            <select name="filter" class="form-control-sm text-center" onchange="enviar()">
                <option value="">Filtro</option>
                <option value="1">Primer Año</option>
                <option value="2">Segundo Año</option>
                <option value="3">Tercer Año</option>
                <option value="4">Cuarto Año</a></option>
                <option value="5">Quinto Año</option>
                <option value="6">Sexto Año</option>
            </select>
    </form>

<div>
            <table class="table table-primary table-striped table-hover table-borderless mb-3">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Division</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($student as $students)
                    <tr class="table-success">
                        <th>{{$students->dni}}</th>
                        <th>{{$students->name}}</th>
                        <th>{{$students->lastName}}</th>
                        <th>{{$students->birthDate}}</th>
                        <th>{{$students->division}}</th>
                        <th><a href="{{route('student.edit',$students->id)}}"><button class="btn btn-warning">Modificar</button></a></th>
                        <th>
                        <form action="{{route('student.destroy',$students->id)}}" method="post">
                            @csrf  
                            @method("delete")
                            <button class="btn btn-danger" type="submit" id="botonEliminar" onclick="return confirmar()">Eliminar</button>
                        </form>
                        </th>
                        <th>
                            <a href="{{route('student.assistList',$students->id)}}"><button class="btn btn-info">Cantidad de Asistencias</button></a>
                        </th>
                        <th>
                            <a href="{{route('student.condition',$students->id)}}"><button class="btn btn-info">Condicion</button></a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <script>
            function enviar(){
                let form = document.getElementById("form");
                form.submit();
            }
        </script>
@endsection