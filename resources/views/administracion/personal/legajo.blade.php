@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-2">
        <div class="col cl-6">
            <div class="row mt-2 derecha">
                <div class="col cl-2 text-derecha ">
                    <img src="{{ asset('logos/return-button.png') }}" onclick="goBack()" class="center link">
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                
               
                    <h5>{{utf8_encode($personal['name'])}}</h5>
                </div>
                <div class="card-body">

                    <div class="container">
                        <div class="row">

                            <div class="col-sm">

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Código</label>
                                    <div class="col-sm-3">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['id']}}">
                                    </div>
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Legajo</label>
                                    <div class="col-sm-3">
                                        <input type="text" readonly class="form-control" id="inputPassword"
                                            value="{{$personal['legajo']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{utf8_encode($personal['name'])}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Domicilio</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['domicilio']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Localidad</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['localidad']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Código postal</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['cp']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Provincia</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['provincia']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Partido</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['zona']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Estado civil</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Nacionalidad</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['nacionalidad']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Teléfono</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['phone_fijo']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Móvil</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['phone_movil']}}">
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm">

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Tipo Doc.</label>
                                    <div class="col-sm-3">
                                        <input type="text" readonly class="form-control" id="staticEmail" value="">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" readonly class="form-control" id="inputPassword"
                                            value="{{$personal['ndoc']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Fecha Nac.</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['fecha_nac']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Lugar Nac.</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['lugar_nac']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">CUIL/CUIT</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['cuil']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Obra social</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['obra_social']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Banco</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['banco']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">CUR</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['cur']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Empresa</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['empresa']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Supervisor</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['name_supe']}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Categoria</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control" id="staticEmail"
                                            value="{{$personal['categoria']}}">
                                    </div>
                                </div>

                                <a type="button" href="/asignaciones/{{$personal['id']}}"
                                    class="btn btn-secondary btn-lg btn-block">Ver
                                    asignaciones</a>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection