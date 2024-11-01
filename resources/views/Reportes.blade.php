@extends('index')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/egresos.css') }}">
@endsection

@section('content')
<!-- cards en foreach con datos de servicios clinicos -->
 <h3>Servicios Clinicos Asociados</h3>
<div>
    @foreach ($serviciosClinicosusuario as $clinico)
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Nombre: {{ $clinico->nombre }}</h5>
                <h6 class="card-subtitle text-muted">ID: {{ $clinico->id }}</h6>
            </div>
            <div class="card-body">
                <h6>Ropa Sucia:</h6>
                <ul class="list-group">
                    @foreach ($clinico->ropas as $ropa)
                        @if ($ropa->pivot->estado == 'sucia')
                            <li class="list-group">
                                <span>{{ $ropa->tipo }}</span>
                                <span>Cantidad: {{ $ropa->pivot->cantidad }}</span>
                                <span>Estado: {{ $ropa->pivot->estado }}</span>
                            </li>
                        @endif
                        @endforeach
                </ul>
                <h6>Ropa limpia:</h6>
                <ul class="list-group">
                    @foreach ($clinico->ropas as $ropa)
                        @if ($ropa->pivot->estado == 'limpia')
                            <li class="list-group">
                                <span>{{ $ropa->tipo }}</span>
                                <span>Cantidad: {{ $ropa->pivot->cantidad }}</span>
                                <span>Estado: {{ $ropa->pivot->estado }}</span>
                            </li>
                        @endif
                        @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>

<!-- cards en foreach con los movimientos de servicios clinicos -->

<h3>Movimiento Realizados</h3>
<div>
    @foreach ($movimientos as $clinico)
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Entrante: {{ $clinico->sEntrante }} | Saliente: {{$clinico->sSaliente}}| {{$clinico->tipoMovimiento}} </h5>
                <h6 class="card-subtitle text-muted">ID: {{ $clinico->id }}</h6>
            </div>
            <div class="card-body">
                <h6>Ropa Sucia:</h6>
                <ul class="list-group">
                    @foreach ($clinico->ropas as $ropa)
                        @if ($ropa->pivot->estado == 'sucia')
                            <li class="list-group">
                                <span>{{ $ropa->tipo }}</span>
                                <span>Cantidad: {{ $ropa->pivot->cantidad }}</span>
                                <span>Estado: {{ $ropa->pivot->estado }}</span>
                            </li>
                        @endif
                        @endforeach
                </ul>
                <h6>Ropa limpia:</h6>
                <ul class="list-group">
                    @foreach ($clinico->ropas as $ropa)
                        @if ($ropa->pivot->estado == 'limpia')
                            <li class="list-group">
                                <span>{{ $ropa->tipo }}</span>
                                <span>Cantidad: {{ $ropa->pivot->cantidad }}</span>
                                <span>Estado: {{ $ropa->pivot->estado }}</span>
                            </li>
                        @endif
                        @endforeach
                </ul>
                <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
            </div>
        </div>
    @endforeach
</div>
@endsection