@extends('layouts')

@section('content')

    <h1 class="my-3 text-center">Datos del Alumno</h1>
        <table class="table table-primary table-striped table-hover table-borderless mb-3">
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
                <tr class="table-success">
                    <th>{{$students->dni}}</th>
                    <th>{{$students->name}}</th>
                    <th>{{$students->lastName}}</th>
                    <th>{{$students->birthDate}}</th>
                    <th>{{$students->group}}</th>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h3 class="text-center">¿Querés agregarle una asistencia a este alumno?</h3>
        <div class="d-flex justify-content-center">
            @foreach ($student as $students)
            <form action="{{route('student.addAssist')}}" method="post">
                @csrf
                    <input type="hidden" name="id" value="{{$students->id}}">
                <button class="btn btn-success mx-3" type="submit">Si</button></a>
            </form>
            <a href="{{route('student.menu')}}"><button class="btn btn-danger">No</button></a>
            @endforeach
        </div>
@stop