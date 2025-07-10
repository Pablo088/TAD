@extends('layouts')

@section("content_header")
    <h1>Condición General del Alumno</h1>
@stop

@section('content')
    <div>
        <h3>Condición del Alumno en Base a sus Asistencias</h3>

        @switch($assistPercentage)
            @case ($assistPercentage < 60)
                <div class="alert alert-danger text-center">Libre ({{$assistPercentage}}%)</div>
                @break
            @case($assistPercentage >=60 && $assistPercentage < 80)
                <div class="alert alert-warning text-center">Regular ({{$assistPercentage}}%)</div>
                @break
            @case($assistPercentage >=80)
                <div class="alert alert-success text-center">Promocionado ({{$assistPercentage}}%)</div>
                @break
        @endswitch
    </div>
    
     <div>
        <h3>Listado total de asistencias del alumno</h3>
        
        <table>
            <thead>
                <tr>
                    <th>Fechas de Asistencia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student_assist as $assist)
                    <tr>
                        <td>{{$assist->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section("content_footer")
    <a href="{{route('student.list')}}"><button class="btn btn-secondary">Volver</button></a>
@stop