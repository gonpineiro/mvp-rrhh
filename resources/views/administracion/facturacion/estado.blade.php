@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-2">
        <div class="col cl-6">
            <div class="row mt-2">
                <div class="col cl-2 box">
                    <h3 class="table-title">Estado Facturacion </h3>
                    <img src="{{ asset('logos/xlsx.png') }}" class="link">
                </div>
                <div class="col cl-2 text-derecha ">
                    <img src="{{ asset('logos/return-button.png') }}" onclick="goBack()" class="center link">
                </div>
            </div>
            <table class="table table-hover" id="normal">
                <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">N° Proforma</th>
                        <th scope="col">Creado</th>
                    </tr>
                </thead>
                <tbody>
                    @while ($factura = odbc_fetch_array($facturas))
                    <tr>
                        <td>{{$factura['cliente']}}</td>
                        <td>{{$factura['empresa']}}</td>
                        <td>{{$factura['fecha']}}</td>
                        <td>{{$factura['cantidad_uno']}}</td>
                        <td>{{$factura['proforma']}}</td>
                        <td>{{$factura['tiempo']}}</td>
                    </tr>
                    @endwhile
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection