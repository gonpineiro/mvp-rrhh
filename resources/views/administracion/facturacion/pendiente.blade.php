@extends('layouts.app')

@section('content')
 <div class="container">
  <div class="row mt-2">
    <div class="col cl-6">
      <h3>Estado facturacion </h3>
        <br>
        <table class="table table-hover" id="host-table">
          <thead>
            <tr>
              <th scope="col">Cliente</th>
              <th scope="col">Empresa</th>
              <th scope="col">Fecha</th>
              <th scope="col">Cantidad</th>
              <th scope="col">N° Proforma</th>
              <th scope="col">Creado</th>
            </tr>
          </thead>
          <tbody>
            @while ($factura = odbc_fetch_array($facturas))
              <tr>
                <td>{{$factura['cliente']}}</td>
              </tr>
            @endwhile
          </tbody>
        </table>
    </div>
    <script >
            $(document).ready(function() {
            $('#host-table').DataTable({
              "order": [[ 0, "desc" ]]
            });
              } );
    </script>
  </div>
</div>
@endsection
