<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte</title>
    @vite("resources/css/report.css")
</head>
<body>
    <h1>
        Reporte de {{$mensaje}}. 
        <p>Carrera: {{$careerName}}. Año: {{$current_year}} año. Division: {{$divisionName}}.</p>
    </h1>
    <div>
        <table>
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    @foreach($student as $students)
                        @if(isset($students->asistencias))
                            <th>Cantidad de Asistencias</th>
                            break;
                        @endif
                        @if(isset($students->prom_notas))
                            <th>Promedio de Notas</th>
                            break;
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @foreach($student as $students)
                <tr>
                    <td>{{$students->dni}}</td>
                    <td>{{$students->student_name}}</td>
                    @if(isset($students->asistencias))
                        <td>{{$students->asistencias}}</td>
                    @endif
                    @if(isset($students->prom_notas))
                        <td>{{$students->prom_notas}}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>