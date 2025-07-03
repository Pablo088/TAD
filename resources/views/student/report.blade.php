@extends('layouts')

@section("content_header")
    <h1>Reporte de Alumnos Promocionados</h1>
@stop

@section('content')
    <div>
        <table class="table table-primary table-bordered table-hover my-3">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Division</th>
                    <th>Promedio de Notas</th>
                    <th>Asistencias</th>
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
                    <th>{{$students->prom}}</th>
                    <th>{{$students->assist}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop