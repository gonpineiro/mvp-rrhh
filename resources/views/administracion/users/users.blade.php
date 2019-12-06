@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row mt-2">
      <div class="col cl-8">
        <h3>Usuarios</h3>
        <br>
          <table class="table table-hover" id="host-table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                {{-- <th scope="col">Rol</th> --}}
                @can ('users.edit') <th scope="col">Editar</th> @endcan
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    {{-- <td>{{$user->roles[0]->name}}</td> --}}
                    @can ('users.edit') <td><a href="/edit_user/{{$user->id}}" ><img src={{asset("logos/edit-logo.png")}} style="width: 17px;"></a></td> @endcan
                  </tr>
                @endforeach
            </tbody>
          </table>
      </div>
      @can('users.create') <div class="col col-md-4"> @else @can ('users.edit') <div class="col col-md-4"> @else <div class="col col-md-4" hidden> @endcan @endcan

        @if ($ver == "agregar") <h3>Agregar</h3> @endif
        @if ($ver == "editar") <h3>Agregando Supervisor</h3> @endif
          <br>
        @can('users.create') <div class="card"> @else @can ('users.edit') <div class="card"> @else <div class="card" hidden> @endcan @endcan
          @if ($ver == "agregar") <div class="card-header">Agregar Usuario</div> @endif
          @if ($ver == "editar") <div class="card-header">{{$onlySup['name']}}</div> @endif
            <div class="card-body">
              @if ($ver == "agregar")
                <form method="POST" action="/create_user">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cod_sim">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="line_phone">Password</label>
                            <input id="password" type="text" class="form-control" name="password" value="" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                          <label for="name" >Roles</label>
                          <select class="form-control" name="role" required>
                            <option value="">- - - Seleccione - - -</option>
                            @foreach ($roles as $role)
                              <option value="{{$role->id}}">{{$role->name}} </option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Agregar</button>
                </form>
              @endif

              @if ($ver == "editar")
                <form method="POST" action="/create_sup_user">

                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="line_phone">Nombre</label>
                            <input id="name" type="text" class="form-control" name="sup_name" value="{{$onlySup['name']}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="line_phone">ID DM</label>
                            <input id="supe_codi" type="text" class="form-control" name="supe_codi" value="{{$onlySup['supe_codi']}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="line_phone">Legajo</label>
                            <input id="supe_codi" type="text" class="form-control" name="supe_legajo" value="" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="cod_sim">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="" >
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="line_phone">Password</label>
                            <input id="password" type="text" class="form-control" name="password" value="" >
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Agegar Supervisor</button>
                </form>
              @endif
            </div>
        </div>
      </div>
      <script >
              $(document).ready(function() {
              $('#host-table').DataTable({
                "order": [[ 0, "desc" ]]
              });
                } );
      </script>
    </div>
</div>
@endsection
