<table >
    <thead>
        <tr>
            <th >Cliente</th>
            <th >Total Puesto</th>
        </tr>
    </thead>
    <tbody>
        @while ($pendiente = odbc_fetch_array($pendientes))
        <tr>
            <td>{{utf8_encode($pendiente['cliente'])}}</td>
            <td>{{$pendiente['total']}}</td>
        </tr>
        @endwhile
    </tbody>
</table>