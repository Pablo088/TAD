@extends('layouts')

@section('content')

    <div>
            <table>
                <thead>
                    <tr>
                        <th>Asistencias del Alumno</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student_assist as $assist)
                    <tr>
                        <th>{{$assist->created_at}}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

@endsection    