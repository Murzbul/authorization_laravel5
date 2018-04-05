@extends('layouts.body')

@section('main-content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
    <h2 class="text-center">Lista de Acciones</h2>

    @if(session()->has('message.level'))
        <div class="alert alert-{{ session('message.level') }}">
            {!! session('message.content') !!}
        </div>
    @endif

    <form action="{{ route('action/assign_action') }}">

        {{ csrf_field() }}

        <table class="table table-bordered" id="table" class="display" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Acciones</th>
                @foreach ($roles as $role)
                    <th>{{ $role->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Acciones</th>
                    @foreach ($roles as $role)
                        <th>{{ $role->name }}</th>
                    @endforeach
            </tr>
        </tfoot>
        <tbody>
            @foreach ( $roles_has_actions as $key => $actions )
            <tr>
                <td>{{ $actions[0]->id_action }}</td>
                <td>{{ $actions[0]->action_uses }}</td>
                @foreach ( $actions as $action )
                    <td>
                        <input type='hidden' value="" name='{{$action->id_role}}-{{$action->id_action}}'>
                        <input name="{{$action->id_role}}-{{$action->id_action}}" class="form-control" type="checkbox" @if( $action->status == 'assigned' ) checked @endif>
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
        $('#table').DataTable({"aLengthMenu": [100]});
    });

</script>
@endsection
