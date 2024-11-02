@extends('index')

@section('links')
<link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
@endsection

@section('content')
<div id="carrito_container" class="container">
    <div id="title" class="w-100 text-end p-1">
        <span class="w-100">Reportes</span>
    </div>
    <span class="fw-bold">Servicios Clínicos Asociados</span>
    <div class="table-responsive my-3 rounded-3 shadow">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>ID</th>
                
                    <th>Ropa Sucia</th>
                    <th>Ropa Limpia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($serviciosClinicosusuario as $clinico)
                                <tr>
                                    <td>{{ $clinico->nombre }}</td>
                                    <td>{{ $clinico->id }}</td>
                                    <td>
                                        <ul class="list-group">
                                        @php
                                                $hayRopaLimpia = false;
                                            @endphp

                                            @foreach ($clinico->ropas as $ropa)
                                                @if ($ropa->pivot->estado == 'sucia' && $ropa->pivot->cantidad > 0)
                                                  <li class="list-inline-item"><strong>></strong> {{ $ropa->tipo }} - Cantidad: {{ $ropa->pivot->cantidad }}</li>
                                                               @php
                                                                    $hayRopaLimpia = true;
                                                                            @endphp
                                                                @endif
                                            @endforeach

                                            @if (!$hayRopaLimpia)
                                                <li class="list-inline-item">No Existe Ropa en el servicio Clinico</li>
                                            @endif
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-group">
                                            @php
                                                $hayRopaLimpia = false;
                                            @endphp

                                            @foreach ($clinico->ropas as $ropa)
                                                @if ($ropa->pivot->estado == 'limpia' && $ropa->pivot->cantidad > 0)
                                                  <li class="list-inline-item"><strong>></strong> {{ $ropa->tipo }} - Cantidad: {{ $ropa->pivot->cantidad }}</li>
                                                               @php
                                                                    $hayRopaLimpia = true;
                                                                            @endphp
                                                                @endif
                                            @endforeach

                                            @if (!$hayRopaLimpia)
                                                <li class="list-inline-item">No Existe Ropa en el servicio Clinico</li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <span class="fw-bold">Movimientos Realizados</span>
<div class="table-responsive my-3 rounded-3 shadow">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Entrante</th>
                <th>Saliente</th>
                <th>Fecha y Hora</th>
                <th>Tipo de Movimiento</th>
                <th>Ropa Sucia</th>
                <th>Ropa Limpia</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movimientos as $clinico)
                <tr>
                <td>{{ $clinico->sEntrante }}</td>
                    <td>{{ $clinico->sSaliente }}</td>
                    <td>{{ \Carbon\Carbon::parse($clinico->created_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ $clinico->tipoMovimiento }}</td>
                    <td>
                        <ul class="list-group">
                            @php
                                $hayRopaSucia = false;
                            @endphp
                            @foreach ($clinico->ropas as $ropa)
                                @if ($ropa->pivot->estado == 'sucia' && $ropa->pivot->cantidad > 0)
                                    <li class="list-inline-item"><strong>></strong> {{ $ropa->tipo }} - Cantidad: {{ $ropa->pivot->cantidad }}</li>
                                    @php
                                        $hayRopaSucia = true;
                                    @endphp
                                @endif
                            @endforeach
                            @if (!$hayRopaSucia)
                                <li class="list-inline-item" >No hay ropa sucia asociada</li>
                            @endif
                        </ul>
                    </td>
                    <td>
                        <ul class="list-group">
                            @php
                                $hayRopaLimpia = false;
                            @endphp
                            @foreach ($clinico->ropas as $ropa)
                                @if ($ropa->pivot->estado == 'limpia' && $ropa->pivot->cantidad > 0)
                                    <li class="list-inline-item"><strong>></strong> {{ $ropa->tipo }} - Cantidad: {{ $ropa->pivot->cantidad }}</li>
                                    @php
                                        $hayRopaLimpia = true;
                                    @endphp
                                @endif
                            @endforeach
                            @if (!$hayRopaLimpia)
                                <li class="list-inline-item">No hay ropa limpia asociada</li>
                            @endif
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


</div>

@endsection