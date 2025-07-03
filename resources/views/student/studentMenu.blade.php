@extends('layouts')

@section("head")
    @vite("resources/css/student/student-menu.css")
@stop

@section("content_header")
    <div id="general-actions">
        <div id="general-buttons">
            <a class="mx-1" href="{{route('student.new')}}"><button class="btn btn-outline-primary">Agregar Alumno</button></a>
            <a class="mx-1" href="{{route('list.pdf')}}"><button class="btn btn-outline-secondary">Exportar a PDF</button></a>
            <a class="mx-1" href="{{route('report.pdf')}}"><button class="btn btn-outline-secondary">Reporte</button></a>
        </div>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
    
    @foreach($cumpleanios as $cumple)   
        @if($cumple)
            <div class="alert alert-success text-center">
                ¡Muy feliz cumpleaños {{$cumple->name}} {{$cumple->lastName}}!
            </div>
        @endif    
    @endforeach
    
    <script>
        function confirmar(){
            let respuesta = confirm("¿Estás seguro? Esta acción no se puede deshacer");
            if(respuesta == true){
                return true;
            } else{
                return false;
            }
        }
    </script>

    <div id="filters-container">
        <form class="filter-form" class="mb-3 d-flex justify-content-center" action="{{route('student.filter')}}" method="get">
            <input type="search" name="input-filter" id="input-filter" class="form-control" placeholder="Buscar por nombre y apellido">
        </form>

        <form class="filter-form" class="mb-3 d-flex justify-content-center" action="{{route('student.filter')}}" method="get">
            <select name="select-filter" id="select-filter" class="form-control text-center" onchange="enviar()" id="filter">
                <option value="">Filtro por Año</option>
                <option value="1">Primer Año</option>
                <option value="2">Segundo Año</option>
                <option value="3">Tercer Año</option>
                <option value="4">Cuarto Año</a></option>
                <option value="5">Quinto Año</option>
                <option value="6">Sexto Año</option>
            </select>
        </form>

        <form class="filter-form" class="mb-3 d-flex justify-content-center" action="{{route('student.filter')}}" method="get">
            <select name="select-filter" id="select-filter" class="form-control text-center" onchange="enviar()" id="filter">
                <option value="">Filtro por Año</option>
                <option value="A">A</option>
                <option value="B">B</option>
            </select>
        </form>
    </div>

    <div>
        <table class="table table-primary table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th class="text-end">DNI</th>
                    <th class="text-center">Nombre Completo</th>
                    <th class="text-center">Fecha de Nacimiento</th>
                    <th class="text-center">Año</th>
                    <th class="text-center">Division</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($student as $students)
                <tr class="table-success">
                    <td class="text-end">{{$students->dni}}</td>
                    <td class="text-center">{{$students->name}} {{$students->lastName}}</td>
                    <td class="text-center">{{$students->birthDate}}</td>
                    <td class="text-center">{{$students->year}}</td>
                    <td class="text-center">{{$students->division}}</td>
                    <td class="text-center" style="display: grid;">
                        <a href="{{route('student.edit',$students->id)}}"><button class="btn btn-warning my-1">Modificar</button></a>
                        
                        <a href="{{route('student.info',$students->id)}}"><button class="btn btn-info my-1">Condicion General</button></a>
                        
                        <a href="{{route('student.notas',$students->id)}}"><button class="btn btn-warning my-1">Agregar Nota</button></a>
                        
                        <form action="{{route('student.destroy',$students->id)}}" method="post">
                            @csrf  
                            @method("delete")
                            <button type="submit" id="botonEliminar" onclick="return confirmar()" class="btn btn-danger th-btn">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
    <script>
        function enviar(){
            let form = document.getElementById("filter-form");
            form.submit();
        }
    </script>
@stop