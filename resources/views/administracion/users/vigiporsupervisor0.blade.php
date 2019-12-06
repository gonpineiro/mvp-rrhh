@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row mt-2">
      <div class="col cl-6">
        <h3>{{$sup['name']}} </h3>
          <br>
          <table class="table table-hover" id="host-table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Legajo</th>
                <th scope="col">Nombre</th>
              </tr>
            </thead>
            <tbody>
              @while ($vig = odbc_fetch_array($vigs))
                <tr>
                  <td>{{$vig['pers_codi']}}</td>
                  <td>{{$vig['legajo']}}</td>
                  <td>{{$vig['name']}}</td>
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
