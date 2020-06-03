@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-2">
        <div class="col cl-6">

            <div class="row mt-2">
                <div class="col cl-2 box">
                    <h3 class="table-title">Asociados con personal a cargo </h3>
                <a href="/sup_users/excel"><img src="logos/xlsx.png" class="link"></a> 
                </div>
                <div class="col cl-2 text-derecha ">
                    <img src="logos/return-button.png" onclick="goBack()" class="center link">
                </div>
            </div>

            <table class="table table-hover" id="normal">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        {{-- <th scope="col">Legajo</th> --}}
                        <th scope="col">Nombre</th>
                        {{-- <th scope="col">Empresa</th> --}}
                        <th class="center" scope="col">Personal</th>
                        @can ('users.create') <th class="center" scope="col">Generar</th> @endcan
                    </tr>
                </thead>
                <tbody>
                    @while ($supervisor = odbc_fetch_array($supervisores))
                    <tr>
                        <td>{{$supervisor['supe_codi']}}</td>
                        {{-- <td>{{$supervisor['legajo']}}</td> --}}
                        <td>{{utf8_encode($supervisor['name'])}}</td>
                        {{-- <td>{{$supervisor['empr_nomb']}}</td> --}}
                        <td class="center"> <a href="show_perso_ger/{{$supervisor['supe_codi']}}"><img
                                    src="logos/add-user.png" class="icon"></a></td>
                        @can ('users.create') <td class="center"> <a
                                href="add_sup_user/{{$supervisor['supe_codi']}}"><img src="logos/add-cred.png"
                                    class="icon"></a></td>@endcan
                    </tr>
                    @endwhile
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@php
function limpia_espacios($cadena){
$cadena = str_replace(' ', '', $cadena);
return $cadena;
}
@endphp