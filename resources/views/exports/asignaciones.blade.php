<table >
    <thead>
        <tr>
            <th >Fecha</th>
            <th >Desde</th>
            <th >Hasta</th>
            <th >Horario</th>
            <th >Puesto</th>
            <th >Objetivo</th>
        </tr>
    </thead>
    <tbody>
        @while ($asignacione = odbc_fetch_array($asignaciones))
        <tr>
            <td>{{$asignacione['fecha']}}</td>
            <td>{{$asignacione['desde']}}</td>
            <td>{{$asignacione['hasta']}}</td>
            <td>{{$asignacione['horario']}}</td>
            <td>{{$asignacione['puesto']}}</td>
            <td>{{$asignacione['objetivo']}}</td>
        </tr>
        @endwhile
    </tbody>
</table>

