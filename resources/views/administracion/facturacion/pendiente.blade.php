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
              <th scope="col">Total Puesto</th>
            </tr>
          </thead>
          <tbody>
            @while ($pendiente = odbc_fetch_array($pendientes))
              <tr>
                <td>{{$pendiente['cliente']}}</td>
                <td>{{$pendiente['total']}}</td>
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
