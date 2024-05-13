<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand mx-2">TAD</a>
        <div class="me-auto">
            <a href="{{route('student.index')}}"> <button class="btn btn-outline-info">Inicio</button></a>
            <a href="{{route('student.menu')}}"><button class="btn btn-outline-light">Menu</button></a>
            <a href="{{route('student.settings')}}"><button class="btn btn-outline-info">Configuración</button></a>
        </div>
    </nav>

    <form action="" method="post">
        @csrf
        @method("put")
        <h3>Dias de Clase</h3>
        <input type="number" name="dias_clase">
        <h3>Promedio de Promoción</h3>
        <input type="number" name="promedio_promocion">
        <h3>Promedio de Regularidad</h3>
        <input type="number" name="promedio_regularidad">
        <h3>Edad Minima (Para entrar a la facultad)</h3>
        <input type="number" name="edad_minima">
    </form>
</body>
</html>