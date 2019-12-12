@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row mt-2">
      <div class="col cl-6">
          <br>
          <table class="table table-hover" id="host-table">
            <thead>
              <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Legajo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Reportar</th>
                <th scope="col">Fecha</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($rrhhreports as $rrhhreport)
                @if ($rrhhreport->estado == 1)
                <tr>
                  <td>{{$rrhhreport['pers_codi']}}</td>
                  <td>{{$rrhhreport['pers_lega']}}</td>
                  <td>{{$rrhhreport['pers_nomb']}}</td>
                  <td> <a href="/change_estate/{{$rrhhreport->id}}"><img src="{{asset("logos/add-cred.png")}}" style="width: 20px;"></a> </td>
                  <td>{{$rrhhreport->created_at}}</td>
                </tr>
                @endif
              @endforeach
            </tbody>
          </table>
      </div>
      <script >
          //JQUERY TABLLE
          $(document).ready(function() {
          $('#host-table').DataTable({
            "order": [[ 0, "desc" ]]
          });
            } );


      </script>
    </div>
  </div>

@endsection
