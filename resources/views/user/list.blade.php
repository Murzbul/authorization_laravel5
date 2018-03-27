@extends('layouts.body')

@section('main-content')

<div class="row justify-content-center">
    <div class="col-10 col-md-10 col-lg-10">
    <h2 class="text-center">Lista de Usuarios</h2>
        <table id="table" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Creado</th>
                <th>Modificado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Creado</th>
                <th>Modificado</th>
                <th>Acción</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('user/editing', ['id' => $user->id]) }}">Editar</a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_modal_{{ $user->id }}">Eliminar</button>
                    @include('layouts.delete', ['id' => $user->id, 'item' => $user->name, 'route' => 'user/delete', 'title' => 'Usuario a eliminar', 'content' => '¿Está seguro que desea eliminar al usuario?' ])
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>

<div class="row  justify-content-center mt-3">
    <div class="col-12 col-sm- 12 col-md-6 col-lg-6">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title text-center">Agregar Usuarios</h3>
          <p class="card-text">
              <form class="" action="{{ url('usuario/crear')}}" method="post">

                  @if(session()->has('message.level'))
                      <div class="alert alert-{{ session('message.level') }}">
                          {!! session('message.content') !!}
                      </div>
                  @endif

                  {{ csrf_field() }}

                  <div class="form-group">
                      <label for="name">Nombre</label>
                      <input class="form-control" name="name" type="text">
                  </div>

                  <div class="form-group">
                      <label for="email">Email</label>
                      <input class="form-control" name="email" type="email">
                  </div>

                  <div class="form-group">
                      <label for="email">Contraseña</label>
                      <input class="form-control" name="password" type="password">
                  </div>

                  <div class="form-group">
                      <label for="email">Repetir Contraseña</label>
                      <input class="form-control" name="repassword" type="password">
                  </div>

                  <div class="form-group text-center">
                      <input class="btn btn-primary" name="submit" type="submit">
                  </div>

              </form>
          </p>
        </div>
      </div>
    </div>
</div>

@endsection

@section('js')
    @parent
<script>

    $(document).ready(function(){
        $('#table').DataTable();
    });

</script>
@endsection
