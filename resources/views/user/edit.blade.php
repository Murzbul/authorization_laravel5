@extends('layouts.body')

@section('main-content')

<div class="row justify-content-center">
      <div class="col-md-9 col-md-push-1">

          <h2 class="text-center">Editar Usuario</h2>

          <form class="" action="{{ route('user/edited', ['id' => $user->id]) }}" method="post">

              @if(session()->has('message.level'))
                  <div class="alert alert-{{ session('message.level') }}">
                      {!! session('message.content') !!}
                  </div>
              @endif

              {{ csrf_field() }}

              <div class="form-group">
                  <input class="form-control" name="id" type="hidden" value="{{ $user->id }}">
              </div>

              <div class="form-group">
                  <label for="name">Nombre</label>
                  <input class="form-control" name="name" type="text" value="{{ $user->name }}">
              </div>

              <div class="form-group">
                  <label for="email">Email</label>
                  <input class="form-control" name="email" type="email" value="{{ $user->email }}">
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
                  <input value="Aceptar" class="btn btn-primary" name="submit" type="submit">
                  <a href="{{ route('user/list') }}" class="btn btn-danger">Cancelar</a>
              </div>

          </form>
      </div>
  </div>
@endsection
