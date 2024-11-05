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
                                                                                    <li class="list-inline-item"><strong>></strong> {{ $ropa->tipo }} - Cantidad:
                                                                                        {{ $ropa->pivot->cantidad }}</li>
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
                                                                                    <li class="list-inline-item"><strong>></strong> {{ $ropa->tipo }} - Cantidad:
                                                                                        {{ $ropa->pivot->cantidad }}</li>
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

    <div id="Ropas" class="e my-3 w-100 rounded-3  ">
        @if(Auth::user()->isAdmin)
            <div class="d-flex align-items-center justify-content-between">
                <span>Reporte de Inventario(Administrador)</span>
            </div>
            <div class="table-responsive my-3 rounded-3 shadow">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Ropa</th>
                            <th>Servicios Asociados</th>
                            <th>Ropa Sucia</th>
                            <th>Ropa Limpia</th>
                            <th>Ropa Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listado as $ropa)
                                        <tr class="">
                                            <td>{{ $ropa['ropa'] }}</td>
                                            <td>
                                                <ul class="list-group">
                                                    @foreach($ropa['servicios'] as $clinico)
                                                        <li class="text-nowrap list-inline-item">
                                                            <strong>></strong> {{ $clinico->nombre }}

                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>

                                            <td class="m-auto text-center">
                                                @php
                                                    $totalRopa = 0; 
                                                  @endphp
                                                @foreach($ropa['servicios'] as $clinico)

                                                            @foreach($clinico->ropas as $ropaItem)
                                                                        @if ($ropaItem->tipo == $ropa['ropa'] && $ropaItem->pivot->estado == 'sucia')
                                                                                    @php
                                                                                        $totalRopa += $ropaItem->pivot->cantidad;
                                                                                      @endphp

                                                                        @endif
                                                            @endforeach

                                                @endforeach
                                                <strong>></strong>Total: {{ $totalRopa }}


                                            </td>
                                            <td class="m-auto text-center">
                                                @php
                                                    $totalRopa = 0; 
                                                  @endphp
                                                @foreach($ropa['servicios'] as $clinico)

                                                            @foreach($clinico->ropas as $ropaItem)
                                                                        @if ($ropaItem->tipo == $ropa['ropa'] && $ropaItem->pivot->estado == 'limpia')
                                                                                    @php
                                                                                        $totalRopa += $ropaItem->pivot->cantidad;
                                                                                      @endphp

                                                                        @endif
                                                            @endforeach

                                                @endforeach
                                                <strong>></strong>Total: {{ $totalRopa }}

                                            </td>
                                            <td class="m-auto text-center">
                                                @php
                                                    $totalRopa = 0; 
                                                  @endphp
                                                @foreach($ropa['servicios'] as $clinico)

                                                            @foreach($clinico->ropas as $ropaItem)
                                                                        @if ($ropaItem->tipo == $ropa['ropa'])
                                                                                    @php
                                                                                        $totalRopa += $ropaItem->pivot->cantidad;
                                                                                      @endphp

                                                                        @endif
                                                            @endforeach

                                                @endforeach
                                                <strong>></strong>Total: {{ $totalRopa }}

                                            </td>

                                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No tienes permiso para ver esta información.</p>
        @endif

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
                                    <td>
                            @if(
                            \Carbon\Carbon::parse($clinico->created_at)->timezone('America/Santiago')->translatedFormat('d/m')
                            ==
                            \Carbon\Carbon::now()->timezone('America/Santiago')->translatedFormat('d/m')
                            )
                            <span>Hoy a las
                                {{
                                Carbon\Carbon::parse($clinico->created_at)->timezone('America/Santiago')->translatedFormat('H:i')
                                }}</span>
                            @elseif(\Carbon\Carbon::parse($clinico->created_at)->timezone('America/Santiago')->isYesterday())
                            <span>Ayer a las
                                {{
                                Carbon\Carbon::parse($clinico->created_at)->timezone('America/Santiago')->translatedFormat('H:i')
                                }}</span>
                            @else
                            <span class="text-capitalize">{{
                                Carbon\Carbon::parse($clinico->created_at)->timezone('America/Santiago')->translatedFormat('D/m/y')
                                }}
                                a las
                                {{ Carbon\Carbon::parse($clinico->created_at)->timezone('America/Santiago')->format('H:i
                                A') }}</span>
                            @endif

                        </td>
                                    <td>{{ $clinico->tipoMovimiento }}</td>
                                    <td>
                                        <ul class="list-group">
                                            @php
                                                $hayRopaSucia = false;
                                            @endphp
                                            @foreach ($clinico->ropas as $ropa)
                                                                @if ($ropa->pivot->estado == 'sucia' && $ropa->pivot->cantidad > 0)
                                                                                    <li class="list-inline-item"><strong>></strong> {{ $ropa->tipo }} - Cantidad:
                                                                                        {{ $ropa->pivot->cantidad }}</li>
                                                                                    @php
                                                                                        $hayRopaSucia = true;
                                                                                    @endphp
                                                                @endif
                                            @endforeach
                                            @if (!$hayRopaSucia)
                                                <li class="list-inline-item">No hay ropa sucia asociada</li>
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
                                                                                    <li class="list-inline-item"><strong>></strong> {{ $ropa->tipo }} - Cantidad:
                                                                                        {{ $ropa->pivot->cantidad }}</li>
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