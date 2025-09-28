    <h1>
        Reporte de Asistencias. 
        <p>{{$careerName}} {{$current_year}} {{$divisionName}}</p>
    </h1>

    <div>
        <table class="table table-primary table-bordered table-hover my-3">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
            @foreach($student as $students)
                <tr class="table-success">
                    <th>{{$students->dni}}</th>
                    <th>{{$students->student_name}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>