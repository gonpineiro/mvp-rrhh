@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-2">
        <div class="col cl-6">
            <div class="row mt-2">
                <div class="col cl-2 box">
                    <h3 class="table-title">Clientes pendientes a facturar </h3>
                    <a href="/pendiente_fac/excel"><img src="{{ asset('logos/xlsx.png') }}" class="link"></a>
                </div>
                <div class="col cl-2 text-derecha ">
                    <img src="{{ asset('logos/return-button.png') }}" onclick="goBack()" class="center link">
                </div>
            </div>
            <table class="table table-hover" id="normal">
                <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Total Puesto</th>
                    </tr>
                </thead>
                <tbody>
                    @while ($pendiente = odbc_fetch_array($pendientes))
                    <tr>
                        {{-- <td><a href="pendiente_fac/{{$pendiente['id']}}">{{utf8_encode($pendiente['cliente'])}}</a></td> --}}
                        <td>{{utf8_encode($pendiente['cliente'])}}</td>
                        <td>{{$pendiente['total']}}</td>
                    </tr>
                    @endwhile
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="row mt-2">
        <div class="col cl-6">
            <div class="row mt-2">
                <p>Puestos que contienen al menos una asignación (facturables) realizadas en el periodo configurado. </p>
            </div>
            <div class="row mt-2">
                {{$puestoChart->container()}}
                {!! $puestoChart->script() !!}
            </div>
        </div>
        <div class="col cl-6">
            <div class="row mt-2">
            <p>Clientes que contienen puestos facturables. Solamente se contabilizan como facturado los clientes que presenten el 100%
            de los puestos facturados.</p>
                <!-- <h3>Clientes: {{$cantidadClientes}}</h3> -->
            </div>
            <div class="row mt-2">
                {{$clienteChart->container()}}
                {!! $clienteChart->script() !!}
            </div>
        </div>
    </div>
</div>

@endsection