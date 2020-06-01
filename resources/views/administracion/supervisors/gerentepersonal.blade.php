@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-2">
        <div class="col cl-6">
            <div class="row mt-2">
                <div class="col cl-2 box">
                    <h3 class="table-title">Personal de</h3>
                    <a href="/show_perso_ger/excel/{{$sup['supe_codi']}}"><img src="{{ asset('logos/xlsx.png') }}" class="link"></a>
                </div>
                <div class="col cl-2 text-derecha ">
                    <img src="{{ asset('logos/return-button.png') }}" onclick="goBack()" class="center link">
                </div>
            </div>
            <table class="table table-hover" id="personal">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Legajo</th>
                        <th scope="col">Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="text" name="" value="asd" hidden>
                    @while ($vig = odbc_fetch_array($vigs))
                    <tr href="/only_vig/{{$vig['pers_codi']}}" class="link">
                        <td>{{$vig['pers_codi']}}</td>
                        <td>{{$vig['legajo']}}</td>
                        <td>{{$vig['name']}}</td>
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