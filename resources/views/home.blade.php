@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row mt-2">
    <div class="col cl-6">
         {{-- <a href="/asd" type="button"style="width: 100%;margin: 5px;background-color: #B6252A;" class="btn btn-primary btn-lg">Botón grande</a>
         <a href="/asd" type="button"style="width: 100%;margin: 5px;background-color: #B6252A;" class="btn btn-primary btn-lg">Botón grande</a> --}}
       @can ('facturacion')
         <a href="/estado_fac" type="button"style="width: 100%;margin: 5px;background-color: #B6252A;" class="btn btn-primary btn-lg">Facturacion</a>
       @endcan
       @can ('rrhh')
         <a href="/show_vigs_sup/reports/rrhh" type="button"style="width: 100%;margin: 5px;background-color: #B6252A;" class="btn btn-primary btn-lg">Reportados</a>
       @endcan
       @can ('supervisor')
         <a href="/show_vigs_sup" type="button"style="width: 100%;margin: 5px;background-color: #B6252A;" class="btn btn-primary btn-lg">Personal</a>
         <a href="/show_vigs_sup/reports" type="button"style="width: 100%;margin: 5px;background-color: #B6252A;" class="btn btn-primary btn-lg">Reportados</a>
       @endcan
       @can ('users.show')
         <a href="/users" type="button"style="width: 100%;margin: 5px;" class="btn btn-dark btn-lg">Usuarios</a>
         <a href="/sup_users" type="button"style="width: 100%;margin: 5px;background-color: #B6252A;" class="btn btn-primary btn-lg">Supervisores</a>
       @endcan
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
