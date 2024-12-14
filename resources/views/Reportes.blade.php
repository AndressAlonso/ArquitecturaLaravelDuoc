@extends('index')

@section('links')
<link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
<script>
    document.addEventListener('DOMContentLoaded', function () {
        btnfilter = document.getElementById('btnFilter');
        formfilter = document.getElementById('formfilter');
        btnfilter.addEventListener('onclick', function () {
            console.log('click');
            formfilter.submit();
        });
    });
</script>
@endsection

@section('content')
<div id="carrito_container" class="container">
    <div id="title" class="w-100 text-end p-1">
        <span class="w-100">Reportes</span>
    </div>

    <div class="w-100 d-flex justify-content-between align-items-center">
        <span class="fw-bold">Servicios Clínicos Asociados</span>
       
    </div>
    <div id="filtros">
        <div class="border border-dark-subte my-2"></div>
        <form id="formfilter" method="get" action="{{route('reportes')}}">
            
            <div>
                <div>
                    <span>Servicios Clinicos</span>
                </div>
                <div class="d-flex justify-content-start gap-3 align-items-center flex-wrap">
                    @foreach ($serviciosClinicosusuario as $servicio)
                        <div>
                            <input class="form-check-input" type="checkbox" name="serviciosClinicos[]"
                                value="{{$servicio->nombre}}" id="flexCheckDefault{{$loop->index}}">
                            <label class="form-check-label"
                                for="flexCheckDefault{{$loop->index}}">{{$servicio->nombre}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
           
            <div class="d-flex w-100 justify-content-md-start my-2 justify-content-center">
                <button id="btnFilter" type="submit" class="btn btn-outline-primary text-dark border-0">
                    <svg id="Capa_1" width="20" height="20" enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                        xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path
                                d="m0 0v93.925l202.086 205.19v212.885l107.828-68.379v-144.506l202.086-205.19v-93.925zm482 29.963v42.891h-452v-42.891zm-202.086 256.972v140.219l-47.828 30.33v-170.549l-181.333-184.118h410.494z" />
                        </g>
                    </svg>
                    Filtrar
                </button>
            </div>
        </form>
        <div class="border border-dark-subte my-2"></div>
    </div>
    <div class="table-responsive my-3 rounded-3 shadow">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>ID</th>

                    <th>
                        <span>Ropa Sucia</span>

                    </th>
                    <th>Ropa Limpia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ssclinicosFiltro as $clinico)
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
                                                                                        {{ $ropa->pivot->cantidad }}
                                                                                    </li>
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
                                                                                        {{ $ropa->pivot->cantidad }}
                                                                                    </li>
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
            <div class="w-100 d-flex justify-content-between align-items-center">
                <span class="fw-bold">Servicios Clínicos Asociados</span>

            </div>
            <div id="filtros">
                <div class="border border-dark-subte my-2"></div>
                <form id="formfilter" method="get" action="{{route('reportes')}}">
                    <div>
                        <div>
                            <span>Tipos Ropa</span>
                        </div>
                        <div class="d-flex justify-content-start gap-3 align-items-center">
                            @foreach ($ropas as $ropa)
                                <div class="text-nowrap">
                                    <input class="form-check-input" type="checkbox" name="tiposRopa[]" value="{{$ropa->tipo}}"
                                        id="ropa{{$loop->index}}">
                                    <label class="form-check-label"
                                        for="ropa{{$loop->index}}">{{$ropa->tipo}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex w-100 justify-content-md-start my-2 justify-content-center">
                        <button id="btnFilter" type="submit" class="btn btn-outline-primary text-dark border-0">
                            <svg id="Capa_1" width="20" height="20" enable-background="new 0 0 512 512"
                                viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path
                                        d="m0 0v93.925l202.086 205.19v212.885l107.828-68.379v-144.506l202.086-205.19v-93.925zm482 29.963v42.891h-452v-42.891zm-202.086 256.972v140.219l-47.828 30.33v-170.549l-181.333-184.118h410.494z" />
                                </g>
                            </svg>
                            Filtrar
                        </button>
                    </div>
                </form>
                <div class="border border-dark-subte my-2"></div>
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
                        @foreach ($listadoFiltrado as $ropa)
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
                                                                                        {{ $ropa->pivot->cantidad }}
                                                                                    </li>
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
                                                                                        {{ $ropa->pivot->cantidad }}
                                                                                    </li>
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