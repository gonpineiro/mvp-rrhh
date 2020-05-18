@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-2">
        <div class="col cl-6">
            <h3>Puestos pendientes de {{$cliente['cliente']}}</h3>
            <br>
            <table class="table table-hover" id="Normal">
                <thead>
                    <tr>
                        <!-- <th scope="col">Cliente</th> -->
                        <th scope="col">Puesto</th>
                        <th scope="col">Cant. Asignaciones</th>
                        {{-- <th scope="col">Desde</th>
                        <th scope="col">Hasta</th> --}}
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @while ($pendiente = odbc_fetch_array($pendientes))
                    <tr>
                        <!-- <td>{{$pendiente['cliente']}}</td> -->
                        <td>{{$pendiente['puesto']}}</td>
                        <td>{{$pendiente['cantidad_asig']}}</td>
                        {{-- <td>{{$pendiente['desde']}}</td>
                        <td>{{$pendiente['dhor']}}</td> --}}
                        <td>{{Carbon\Carbon::parse($pendiente['asig_dhor'])->diffInHours(Carbon\Carbon::parse($pendiente['asig_hhor']))}}
                        </td>
                    </tr>
                    @endwhile
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection