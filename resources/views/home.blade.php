@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row mt-2">
    <div class="col cl-6">
      <h3>Monitores @can ('monitors.create') <a href="/form_monitor"> +</a> @endcan </h3>
        <br>
        <table class="table table-hover" id="host-table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Instalado</th>
              <th scope="col">Modelo</th>
              <th scope="col">Usuario</th>
              <th scope="col">Departamento</th>
              <th scope="col">Cliente</th>
            </tr>
          </thead>
          <tbody>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td> </td>
                  <td></td>
                  <td></td>
                </tr>
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
