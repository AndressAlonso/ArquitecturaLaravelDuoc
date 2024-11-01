@extends('index') 

@section('links')
<link rel="stylesheet" href="{{ asset(path: 'css/egresos.css') }}">@endsection
@section('content')
<form method="post" action="{{ route('egresos2') }}" class="d-flex flex-column container">
    @csrf
    <div class="d-flex justify-content-center flex-column ">
        <div id="egresos" class="d-flex flex-column justify-content-center container-fluid">
            <div id="title" class="w-100 text-center fw-bold">
                <span class="fs-4">Egresar</span>
            </div>
            <div id="eDesde" class="d-flex flex-column gap-2">
                <div class="d-flex flex-column">
                    <span>Egresar desde: </span>
                    <select name="ServicioDesde" class="form-select" id="ssServicioDesde">
                        <option value="-1">Elige Servicio Clínico</option>
                        @foreach (json_decode($serviciosClinicosusuario) as $clinicos)
                            <option value="{{ $clinicos->id }}">{{ $clinicos->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="hEgreso" class="d-flex gap-2 flex-column">
                <div class="d-flex flex-column">
                    <span>Egresar hacia: </span>
                    <select name="ServicioHacia" class="form-select" id="ssServicioHacia">
                        <option value="-1">Elige Servicio Clínico</option>
                        @foreach (json_decode($servicioClinicos) as $clinicos)
                            <option value="{{ $clinicos->id }}">{{ $clinicos->nombre }}</option>
                        @endforeach
                    </select>

                </div>

            </div>
        </div>
    </div>
    <div class="row">
        @foreach(json_decode($servicioClinicos) as $clinicos)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">ID: {{ $clinicos->id }}</h5>
                        <h6 class="card-subtitle text-muted">Nombre: {{ $clinicos->nombre }}</h6>
                    </div>
                    <div class="card-body">
                        <h6>Ropas:</h6>
                        <ul class="list-group">
                            @foreach($clinicos->ropas as $ropa)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $ropa->tipo }}
                                    <span class="badge badge-primary text-black-50 badge-pill">Cantidad: {{ $ropa->pivot->cantidad }}</span>
                                    <span class="badge badge-secondary text-black-50 badge-pill">Estado: {{ $ropa->pivot->estado }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="confirmarEgreso" class="w-100 d-flex justify-content-center align-items-center py-3">
        <button type="submit" class="btn btn-light w-75">Egresar</button>
    </div>
</form>


@endsection