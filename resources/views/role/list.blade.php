@extends('layouts.body')

@section('main-content')

    <h2 class="text-center">Lista de Roles</h2>

        <table id="table" class="display" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Creado</th>
                <th>Modificado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Creado</th>
                <th>Modificado</th>
                <th>Acción</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td>{{ $role->created_at }}</td>
                <td>{{ $role->updated_at }}</td>
                <td class="text-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('role/editing', ['id' => $role->id]) }}">Editar</a>
                    <br>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_modal_{{ $role->id }}">Eliminar</button>
                    @include('layouts.delete', ['id' => $role->id, 'route' => 'role/delete', 'title' => 'Rol a eliminar', 'content' => '¿Está seguro que desea eliminar el rol?' ])
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <div class="row">
        <div class="col-md-10 col-md-push-1">

            <h2 class="text-center">Agregar Rol</h2>

            <form class="" action="{{ route('role/create')}}" method="post">

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
                    <label for="email">Descripción</label>
                    <textarea class="form-control" name="description" rows="8" cols="80"></textarea>
                </div>

                <div class="form-group text-center">
                    <input class="btn btn-primary" name="submit" type="submit">
                </div>

            </form>
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
