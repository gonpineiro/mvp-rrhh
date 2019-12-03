@extends('layouts.app')

@php
/*
  $ODBCdriver = "Driver={Microsoft Visual FoxPro Driver};SourceType=DBC;SourceDB=C:\SAB5\Database\gsm.dbc;Exclusive=No";
  $user = "";
  $pwd = "";

  $supervisores = "SELECT supe_codi, supe_nomb FROM supervisor WHERE supe_esta <= 1";

  if( !($conID = odbc_connect($ODBCdriver,$user,$pwd)) ){ print("No se pudo establecer la conexión!");exit();}
  if (($result = @odbc_exec($conID, $supervisores)) === false) die("Error en query: " . odbc_errormsg($conID));

  //$q_vig_sup = "SELECT pers_codi, pers_nomb FROM personal WHERE pers_supe LIKE ' %' + 34 AND EMPTY(pers_fegr)";
*/
@endphp

@section('content')

  <div class="container">
    <div class="row mt-2">
      <div class="col cl-6">
        <h3>Supervisores </h3>
          <br>
          <table class="table table-hover" id="host-table">
            <thead>
              <tr>
                <th scope="col">Legajo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Generar</th>
              </tr>
            </thead>
            <tbody>
              @while ($row = odbc_fetch_array($result))
                <tr>
                  <td>{{$row['supe_codi']}}</td>
                  <td>{{$row['supe_nomb']}}</td>
                  <td> <a href="add_sup_user/{{limpia_espacios($row['supe_codi'])}}"><img src="logos/add-user.png" style="width: 20px;"></a></td>
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

@php
  function limpia_espacios($cadena){
    $cadena = str_replace(' ', '', $cadena);
    return $cadena;
  }
@endphp
