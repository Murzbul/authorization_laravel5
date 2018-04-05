@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
          <div class="panel panel-default">
              <div class="panel-heading">Dashboard</div>
              <div class="panel-body">
                  @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif
                  Estas logueado!
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
