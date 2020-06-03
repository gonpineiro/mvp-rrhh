@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-2">
        <div class="col cl-6">
            <div class="row mt-2">
                <div class="col cl-2 box">
                    <h3 class="table-title">Reportados por mi </h3>
                    <img src="{{ asset('logos/xlsx.png') }}" class="link">
                </div>
                <div class="col cl-2 text-derecha ">
                    <img src="{{ asset('logos/return-button.png') }}" onclick="goBack()" class="center link">
                </div>
            </div>
            <table class="table table-hover" id="normal">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Legajo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Observación</th>
                        <th scope="col">Reportar</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rrhhreports as $rrhhreport)
                    @if ($rrhhreport->estado == 1 || $rrhhreport->estado == 2)
                    <tr>
                        <td>{{$rrhhreport['pers_codi']}}</td>
                        <td>{{$rrhhreport['pers_lega']}}</td>
                        <td>{{utf8_encode($rrhhreport['pers_nomb'])}}</td>
                        <td>{{$rrhhreport->comentario_rrhh}}</td>
                        <td> <a href="/change_estate/{{$rrhhreport->id}}">@if ($rrhhreport->estado != 2) <img
                                    src="{{asset("logos/add-cred.png")}}" style="width: 20px;"> @endif </a> </td>
                        <td>{{$rrhhreport->created_at}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection