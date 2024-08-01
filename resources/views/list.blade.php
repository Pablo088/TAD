@extends('layouts')

@section('content')

<div>
            <table class="table table-primary table-striped table-hover table-borderless mb-3">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Año</th>
                        <th>Grupo</th>
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
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
</body>
</html>
@endsection