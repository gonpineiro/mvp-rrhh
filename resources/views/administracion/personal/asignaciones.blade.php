@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-2">
        <div class="col cl-6">
            <div class="row mt-2">
                <div class="col cl-2 box">
                    <h2 class="table-title">Asignaciones de {{ $vig['name'] }}</h2>
                    <a href="/asignaciones/excel/{{$id}}"><img src="{{ asset('logos/xlsx.png') }}" class="link"></a>
                </div>
                <div class="col cl-2 text-derecha ">
                    <img src="{{ asset('logos/return-button.png') }}" onclick="goBack()" class="center link">
                </div>
            </div>
            <table class="table table-hover" id="vigi_por_super">
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
    </div>
</div>

@endsection