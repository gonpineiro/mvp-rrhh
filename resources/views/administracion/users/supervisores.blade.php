

@extends('layouts.app')

@php
  $ODBCdriver = "Driver={Microsoft Visual FoxPro Driver};SourceType=DBC;SourceDB=C:\SAB5\Database\gsm.dbc;Exclusive=No";
  $user = "";
  $pwd = "";

  if( !($conID = odbc_connect($ODBCdriver,$user,$pwd)) ){
      print("No se pudo establecer la conexión!");
      exit();
    } else{
       echo "hay conexion";
       echo "</br>";
   }

  $query = "select personal.pers_codi as id, personal.pers_nomb as nombre, supervisor.supe_nomb as super from personal
            INNER JOIN supervisor
            ON personal.pers_supe = supervisor.supe_codi where personal.pers_cate = 19";

  if (($result = @odbc_exec($conID, $query)) === false )
  	die("Error en query: " . odbc_errormsg($conID));

@endphp

@section('content')

  <div class="container">
    <div class="row mt-2">
      <div class="col cl-6">
        <h3>Monitores @can ('monitors.create') <a href="/form_monitor"> +</a> @endcan </h3>
          <br>
          <table class="table table-hover" id="host-table">
            <thead>
              <tr>
                <th scope="col">Legajo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Supervisor</th>
              </tr>
            </thead>
            <tbody>
              @while ($row = odbc_fetch_array($result))
                <tr>
                  <td>{{$row['id']}}</td>
                  <td>{{$row['nombre']}}</td>
                  <td>{{$row['super']}}</td>
                </tr>
              @endwhile
            </tbody>
          </table>
      </div>
      <script >
              $(document).ready(function() {
              $('#host-table').DataTable({
                "order": [[ 1, "desc" ]]
              });
                } );
      </script>
    </div>
  </div>

@endsection
