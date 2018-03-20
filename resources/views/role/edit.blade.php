@extends('layouts.body')

@section('main-content')

<div class="row  justify-content-center">
      <div class="col-md-9 col-md-push-1">

          <h2 class="text-center">Modificar Rol</h2>

          <form class="" action="{{ route('role/edited', ['id' => $role->id])}}" method="post">

              @if(session()->has('message.level'))
                  <div class="alert alert-{{ session('message.level') }}">
                      {!! session('message.content') !!}
                  </div>
              @endif

              {{ csrf_field() }}

              <div class="form-group">
                  <input class="form-control" name="id" type="hidden" value="{{ $role->id }}">
              </div>

              <div class="form-group">
                  <label for="name">Nombre</label>
                  <input class="form-control" name="name" type="text" value="{{ $role->name }}">
              </div>

              <div class="form-group">
                  <label for="email">Descripción</label>
                  <textarea class="form-control" name="description" rows="8" cols="80">{{ $role->description }}</textarea>
              </div>

              <div class="form-group text-center">
                  <input class="btn btn-primary" name="submit" type="submit">
              </div>

          </form>
      </div>
  </div>
@endsection
