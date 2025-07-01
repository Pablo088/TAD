@extends('layouts')

@section("header")
    @vite("resources/css/student/student-menu.css")
@stop

@section('content')
    <div id="main-content">
        <a class="d-flex justify-content-center my-3" href="{{route('student.new')}}"><button class="btn btn-primary">Agregar Alumno</button></a>
        <a class="d-flex justify-content-center my-3" href="{{route('list.pdf')}}"><button class="btn btn-primary">pdf</button></a>
        <a class="d-flex justify-content-center my-3" href="{{route('report.pdf')}}"><button class="btn btn-primary">Reporte</button></a>

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
                let respuesta = confirm("¿Queres borrrar este registro?");
                if(respuesta == true){
                    return true;
                } else{
                    return false;
                }
            }
        </script>
        <div>
            <table class="table table-primary table-striped table-hover table-borderless mb-3">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Año</th>
                        <th>Division</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($student as $students)
                    <tr class="table-success">
                        <th>{{$students->dni}}</th>
                        <th>{{$students->name}}</th>
                        <th>{{$students->lastName}}</th>
                        <th>{{$students->birthDate}}</th>
                        <th>{{$students->year}}</th>
                        <th>{{$students->division}}</th>
                        <th style="padding: 5px;">
                            <a href="{{route('student.edit',$students->id)}}"><button class="btn btn-warning">Modificar</button></a>

                            
                            <a href="{{route('student.assistList',$students->id)}}"><button class="btn btn-info">Cantidad de Asistencias</button></a>
                            
                            <a href="{{route('student.condition',$students->id)}}"><button class="btn btn-info">Condicion</button></a>
                            
                            <a href="{{route('student.notas',$students->id)}}"><button class="btn btn-warning">Agregar Nota</button></a>
                            
                            <form action="{{route('student.destroy',$students->id)}}" method="post">
                                @csrf  
                                @method("delete")
                                <button type="submit" id="botonEliminar" onclick="return confirmar()" class="btn btn-danger">Eliminar</button>
                            </form>
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
    </div>
@endsection