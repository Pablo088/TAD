@extends('layouts')

@section("head")
    @vite("resources/css/student/studentInfo.css")
@stop

@section("content_header")
    <h1>Condición General del Alumno</h1>
@stop

@section('content')
    <div class="info">
        <h3 class="text-center">Condición del Alumno en Base a sus Asistencias</h3>

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
    
    <div class="info">
        <h3 class="text-center">Listado total de asistencias del alumno</h3>
        <table class="table table-primary table-bordered table-hover table-responsive-sm">
            <thead>
                <tr>
                    <th class="text-center">Asistencias</th>
                </tr>
            </thead>
            <tbody>
                @if($student !== null)
                    @foreach($student as $students)
                        <tr class="table-success">
                            <td class="text-center">{{$students->created_at}}</td>
                        </tr>
                    @endforeach
                @else
                    <div>No hay resultados para mostrar</div>
                @endif
            </tbody>
        </table>
        <div style="display: flex;justify-content: space-between;">
                Resultados: {{$student->firstItem()}} - {{$student->lastItem()}}. Total: {{$student->total()}}
                {{$student->links("pagination::bootstrap-4")}}
        </div>
    </div>

    <div class="info">
        <h3 class="text-center">Listado de notas del alumno</h3>
        <table class="table table-primary table-bordered table-hover table-responsive-sm">
            <thead>
                <tr>
                    <th class="text-center">Unidad</th>
                    <th class="text-center">Parcial</th>
                    <th class="text-center">Nota</th>
                </tr>
            </thead>
            <tbody>
                @if($studentNote !== null)
                    @foreach($studentNote as $notas)
                        <tr class="table-info">
                            <td class="text-center">{{$notas->unidad}}</td>
                            <td class="text-center">{{$notas->nombre_parcial}}</td>
                            <td class="text-center">{{$notas->nota}}</td>
                        </tr>
                    @endforeach
                @else
                    <div>No hay resultados para mostrar</div>
                @endif
            </tbody>
        </table>
        <div style="display: flex;justify-content: space-between;" class="table-footer">
                Resultados: {{$studentNote->firstItem()}} - {{$studentNote->lastItem()}}. Total: {{$studentNote->total()}}
                {{$student->links("pagination::bootstrap-4")}}
        </div>
    </div>

    <footer>
            <a href="{{route('student.list')}}"><button class="btn btn-secondary">Volver</button></a>
    </footer>
@stop