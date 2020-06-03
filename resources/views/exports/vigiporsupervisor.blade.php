<table >
    <thead>
        <tr>
            <th >#</th>
            <th >Legajo</th>
            <th >Nombre</th>
        </tr>
    </thead>
    <tbody>
        @while ($vig = odbc_fetch_array($vigs))
        <tr>
            <td>{{$vig['pers_codi']}}</td>
            <td>{{$vig['legajo']}}</td>
            <td>{{utf8_encode($vig['name'])}}</td>
        </tr>
        @endwhile
    </tbody>
</table>