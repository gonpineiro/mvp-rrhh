@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row mt-2">
      <div class="col cl-6">
        <h3>Asignaciones de: </h3>
          <br>
          <table class="table table-hover" id="host-table">
            <thead>
              <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Desde</th>
                <th scope="col">Hasta</th>
                <th scope="col">Horario</th>
                <th scope="col">Puesto</th>
                <th scope="col">Objetivo</th>
              </tr>
            </thead>
            <tbody>
              <input type="text" name="" value="asd" hidden>
              @while ($asignacione = odbc_fetch_array($asignaciones))
                <tr>
                  <td>{{$asignacione['fecha']}}</td>
                  <td>{{$asignacione['desde']}}</td>
                  <td>{{$asignacione['hasta']}}</td>
                  <td>{{$asignacione['horario']}}</td>
                  <td>{{$asignacione['puesto']}}</td>
                  <td>{{$asignacione['objetivo']}}</td>
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

      $('tr').on("click", function() { 
        if($(this).attr('href') !== undefined) { 
          document.location = $(this).attr('href'); 
          } 
          });


      </script>


    </div>
  </div>

@endsection


