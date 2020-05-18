@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-2">
        <div class="col cl-6">

            <div class="row mt-2">
                <div class="col cl-2 box">
                    <h3 class="table-title">Personal a cargo</h3>
                    <img src="logos/xlsx.png" class="link">
                </div>
                <div class="col cl-2 text-derecha ">
                    <img src="logos/return-button.png" onclick="goBack()" class="center link">
                </div>
            </div>
            <table class="table table-hover" id="vigi_por_super">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Legajo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Reportar</th>
                    </tr>
                </thead>
                <tbody>
                    @while ($vig = odbc_fetch_array($vigs))
                    <tr href="/only_vig/{{$vig['pers_codi']}}" class="link">
                        <td>{{$vig['pers_codi']}}</td>
                        <td>{{$vig['legajo']}}</td>
                        <td>{{$vig['name']}}</td>
                        <td> @if (!verificar($vigReports, $vig['pers_codi']))
                            <a href="/report_vig/{{$vig['pers_codi']}}/" class="confirmation">
                                <img src="{{asset("logos/add-cred.png")}}" style="width: 20px;">
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endwhile

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    //SWEET ALERT   
    $('.confirmation').click(function (e) {
    var href = $(this).attr('href');
    Swal.fire({
        title: "Observación",
        input: 'text',
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Enviar",
        cancelButtonText: "Cancelar",
        allowOutsideClick: false,
        preConfirm:  function (result) {
            window.location.href = href + result;
            console.log(result);
        }
    });

    return false;
    });


    //GENERAR LINK POR REGISTRO EN TABLA
    $('tr').on("click", function() { 
        if($(this).attr('href') !== undefined) { 
            document.location = $(this).attr('href'); 
        } 
    });

</script>

@endsection

@php
function verificar($array, $key){

if ($array == NULL) {
return false;
}
$count = count($array);
for ($i=0; $i < $count; $i++) { if ($key==$array[$i]['pers_codi']) { return true; } } return false; } @endphp