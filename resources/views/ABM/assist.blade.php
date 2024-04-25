<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asistencias</title>
</head>
<body>
    <div>
            <table>
                <thead>
                    <tr>
                        <th>Fecha de Asistencia</th>
                    </tr>
                </thead>
                @foreach ($assist as $asistencia)
                <tbody>
                    <tr>
                        <th>{{$asistencia->created_at}}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
</body>
</html>