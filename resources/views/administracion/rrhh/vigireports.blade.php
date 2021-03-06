@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-2">
        <div class="col cl-6">
        <div class="row mt-2">
                <div class="col cl-2 box">
                    <h3 class="table-title">Asociados reportados</h3>
                </div>
                <div class="col cl-2 text-derecha ">
                    <img src="{{ asset('logos/return-button.png') }}" onclick="goBack()" class="center link">
                </div>
            </div>
            <table class="table table-hover" id="rrhh">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        {{-- <th scope="col">Legajo</th> --}}
                        <th scope="col">Asociado</th>
                        <th scope="col">Supervisor</th>
                        <th scope="col">Observación</th>
                        <th scope="col">Reportar</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rrhhreports as $rrhhreport)
                    @if ($rrhhreport->estado == 1)
                    <tr>
                        <td>{{$rrhhreport['pers_codi']}}</td>
                        {{-- <td>{{$rrhhreport['pers_lega']}}</td> --}}
                        <td>{{utf8_encode($rrhhreport['pers_nomb'])}}</td>
                        <td>{{$rrhhreport->user->name}}</td>
                        <td>{{$rrhhreport->comentario_sup}}</td>
                        <td> <a href="/resolve_report/{{$rrhhreport->id}}/" class="confirmation"><img
                                    src="{{asset("logos/add-cred.png")}}" style="width: 20px;"></a> </td>
                        <td>{{$rrhhreport->created_at}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $('.confirmation').click(function (e) {
        var href = $(this).attr('href');
        Swal.fire({
            title: "Generar un comentario",
            icon: "warning",
            input: 'text',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
            allowOutsideClick: false,
                preConfirm:  function (result) {
                    window.location.href = href + result;
                    console.log(result);
                }
            });

        return false;
    });
</script>

@endsection