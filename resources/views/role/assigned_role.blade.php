@extends('layouts.body')

@section('main-content')

<div class="row justify-content-center">
    <div class="col-10 col-md-10 col-lg-10">
    <h2 class="text-center">Lista de Roles</h2>

    @if(session()->has('message.level'))
        <div class="alert alert-{{ session('message.level') }}">
            {!! session('message.content') !!}
        </div>
    @endif

    <form action="{{ route('role/assign_role') }}">

        {{ csrf_field() }}

        <table class="table table-bordered" id="table" class="display" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Usuarios</th>
                @foreach ($roles as $role)
                    <th>{{ $role->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Usuarios</th>
                    @foreach ($roles as $role)
                        <th>{{ $role->name }}</th>
                    @endforeach
            </tr>
        </tfoot>
        <tbody>
            @foreach ( $users_has_roles as $key => $users )
            <tr>
                <td>{{ $users[0]->id_user }}</td>
                <td>{{ $users[0]->user_name }}</td>
                        @foreach ( $users as $user )
                            <td>
                                <input type='hidden' value="" name='{{$user->id_user}}-{{$user->id_role}}'>
                                <input name="{{$user->id_user}}-{{$user->id_role}}" class="form-control" type="checkbox" @if( $user->status == 'assigned' ) checked @endif>
                            </td>
                        @endforeach
            </tr>
            @endforeach
        </tbody>
        </table>
        <br>
        <div class="text-center form-group">
            <button type="submit" class="btn btn-primary">Actualizar</button>
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
