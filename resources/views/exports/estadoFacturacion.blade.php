<table >
    <thead>
        <tr>
            <th >Cliente</th>
            <th >Empresa</th>
            <th >Fecha</th>
            <th >Cantidad</th>
            <th >Proforma</th>
            <th >Creado</th>
        </tr>
    </thead>
    <tbody>
        @while ($factura = odbc_fetch_array($facturas))
        <tr>
            <td>{{$factura['cliente']}}</td>
            <td>{{$factura['empresa']}}</td>
            <td>{{$factura['fecha']}}</td>
            <td>{{$factura['cantidad_uno']}}</td>
            <td>{{$factura['proforma']}}</td>
            <td>{{$factura['tiempo']}}</td>
        </tr>
        @endwhile
    </tbody>
</table>