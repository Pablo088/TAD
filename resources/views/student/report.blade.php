    <h1>
        {{$msjAsistencia}}. 
        <p class="text-center">Carrera: {{$careerName}}. Año: {{$current_year}} año. Division: {{$divisionName}}.</p>
    </h1>

    <div>
        <table class="table table-primary table-bordered table-hover my-3">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Cantidad Asistencias</th>
                </tr>
            </thead>
            <tbody>
            @foreach($student as $students)
                <tr class="table-success">
                    <td>{{$students->dni}}</td>
                    <td>{{$students->student_name}}</td>
                    <td>{{$students->asistencias}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>