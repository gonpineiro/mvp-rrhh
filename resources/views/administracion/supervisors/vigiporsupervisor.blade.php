@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row mt-2">
      <div class="col cl-6">
        <h3>Personal</h3>
          <br>
          <table class="table table-hover" id="host-table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Legajo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Reportar</th>
              </tr>
            </thead>
            <tbody>
              <input type="text" name="" value="asd" hidden>
              @while ($vig = odbc_fetch_array($vigs))
                <tr>
                  <td>{{$vig['pers_codi']}}</td>
                  <td>{{$vig['legajo']}}</td>
                  <td>{{$vig['name']}}</td>
                  <td> @if (!verificar($vigReports, $vig['pers_codi']))<a href="/report_vig/{{$vig['pers_codi']}}/" class="confirmation"><img src="{{asset("logos/add-cred.png")}}" style="width: 20px;"></a> @endif </td>
                </tr>
              @endwhile

            </tbody>
          </table>
      </div>
      <script >
          //JQUERY TABLLE
          $(document).ready(function() {
          $('#host-table').DataTable({
            "order": [[ 3, "desc" ],[ 2, "asc" ]]
          });
            } );
      </script>

      <script>
      $('.confirmation').click(function (e) {
        var href = $(this).attr('href');
        Swal.fire({
            title: "Observación",
            input: 'text',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Enviar",
            cancelButtonText: "Cancelar",
            allowOutsideClick: false,
            preConfirm:  function (result) {
              window.location.href = href + result;
              console.log(result);
            }
          });

        return false;
      });
      </script>


    </div>
  </div>

@endsection

@php
  function verificar($array, $key){

    if ($array == NULL) {
      return false;
    }
    $count = count($array);
    for ($i=0; $i < $count; $i++) {
      if ($key == $array[$i]['pers_codi']) {
        return true;
      }
    }
    return false;
  }


@endphp
