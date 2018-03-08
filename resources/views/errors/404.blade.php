@extends('layouts.error')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Error al procesar la solicitud</div>

                <div class="card-body">
                    <div class="alert alert-danger">
                        <h2>Página no encontrada</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
