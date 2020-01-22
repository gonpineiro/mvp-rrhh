@extends('layouts.app')

@section('content')
 <div class="container">
  <div class="row mt-2">
    <div class="col cl-6">
      <h3>Puestos pendientes de {{$cliente['cliente']}}</h3>
        <br>
        <table class="table table-hover" id="host-table">
          <thead>
            <tr>
              <!-- <th scope="col">Cliente</th> -->
              <th scope="col">Puesto</th>
              <th scope="col">Cant. Asignaciones</th>
              <th scope="col">Desde</th>
              <th scope="col">Hasta</th>
            </tr>
          </thead>
          <tbody>
            @while ($pendiente = odbc_fetch_array($pendientes))
              <tr>
                <!-- <td>{{$pendiente['cliente']}}</td> -->
                <td>{{$pendiente['puesto']}}</td>
                <td>{{$pendiente['cantidad_asig']}}</td>
                <td>{{$pendiente['desde']}}</td>
                <td>{{$pendiente['hasta']}}</td>
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
