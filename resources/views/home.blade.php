@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row mt-2">
    <div class="col cl-6">
         {{-- <a href="/asd" type="button"style="width: 100%;margin: 5px;background-color: #B6252A;" class="btn btn-primary btn-lg">Botón grande</a>
         <a href="/asd" type="button"style="width: 100%;margin: 5px;background-color: #B6252A;" class="btn btn-primary btn-lg">Botón grande</a> --}}
       
         @can ('facturacion')
         <a href="/estado_fac" type="button" class="btn btn-primary btn-lg red-buttom">Clientes Proformados</a>
       @endcan

       @can ('facturacion')
         <a href="/pendiente_fac" type="button" class="btn btn-primary btn-lg red-buttom">Clientes no Proformados</a>
       @endcan

        @can ('rrhh')
         <a href="/show_vigs_sup/reports/rrhh" type="button" class="btn btn-primary btn-lg red-buttom">Reportados por Supervisor</a>
        @endcan

        @can ('consultar.personal')
         <a href="/show_vigs_sup" type="button" class="btn btn-primary btn-lg red-buttom">Mi Personal</a>
        @endcan

        @can ('consultar.personal')
        <a href="/show_vigs_sup/reports" type="button" class="btn btn-primary btn-lg red-buttom">Reportados por Mi</a>
        @endcan

        @can ('consultar.supervisor')
            <a href="/sup_users" type="button" class="btn btn-primary btn-lg red-buttom">Consulta de Supervisores</a>
        @endcan

        
       
         @can ('users.show')
         <a href="/users" type="button"style="width: 100%;margin: 5px;" class="btn btn-dark btn-lg">Usuarios</a>
        @endcan

     
    </div>
  </div>

</div>

@endsection
