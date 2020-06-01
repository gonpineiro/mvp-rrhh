<table >
    <thead>
        <tr>
            <th >#</th>
            <th >Nombre</th>
        </tr>
    </thead>
    <tbody>
        @while ($supervisor = odbc_fetch_array($supervisores))
        <tr>
            <td>{{$supervisor['supe_codi']}}</td>
            <td>{{$supervisor['name']}}</td>
        </tr>
        @endwhile
    </tbody>
</table>