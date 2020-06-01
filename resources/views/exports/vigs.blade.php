<table >
    <thead>
        <tr>
            <th >#</th>
            <th >Nombre</th>
        </tr>
    </thead>
    <tbody>
        @while ($vig = odbc_fetch_array($vigs))
        <tr>            
            <td>{{$vig['pers_codi']}}</td>
            <td>{{$vig['name']}}</td>
        </tr>
        @endwhile
    </tbody>
</table>