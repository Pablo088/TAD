<div id="table-container">
    <table class="table table-primary table-bordered table-hover table-responsive">
        <thead>
            <tr>
                <th class="text-end">DNI</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Apellido</th>
                <th class="text-center">Fecha de Nacimiento</th>
                <th class="text-center">Año</th>
                <th class="text-center">Grupo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student as $students)
                <tr class="table-success">
                    <td class="text-end">{{$students->dni}}</td>
                    <td class="text-center">{{$students->name}}</td>
                    <td class="text-center">{{$students->lastName}}</td>
                    <td class="text-center">{{$students->birthDate}}</td>
                    <td class="text-center">{{$students->year}}</td>
                    <td class="text-center">{{$students->division}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>