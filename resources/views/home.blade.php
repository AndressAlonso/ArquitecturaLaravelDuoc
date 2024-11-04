@extends('index')
@section('content')
<div class="d-flex flex-grow-1 gap-2 flex-wrap container justify-content-center">
    <span class="w-100 text-end p-1">Home</span>
    <div id="ServiciosClinicios" class="w-100 my-3 rounded-3  ">
        <div class="d-flex flex-column ">
            <span>Tus Servicios Clínicos Asociados</span>
        </div>
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
                                        <tr class="">
                                            <td>{{ $clinico->nombre }}</td>
                                            <td>{{ $clinico->id }}</td>
                                            <td>
                                                <ul class="list-group">
                                                    @php
                                                        $hayRopaSucia = false;
                                                    @endphp
                                                    @foreach($clinico->ropas as $ropa)
                                                                            @if ($ropa->pivot->estado == 'sucia' && $ropa->pivot->cantidad > 0)
                                                                                                    <li class="text-nowrap list-inline-item">
                                                                                                        <strong>></strong> {{ $ropa->tipo }} - Cantidad: {{ $ropa->pivot->cantidad }}
                                                                                                    </li>
                                                                                                    @php
                                                                                                        $hayRopaSucia = true;
                                                                                                    @endphp
                                                                            @endif
                                                    @endforeach

                                                    @if (!$hayRopaSucia)
                                                        <li class="list-inline-item">No Existe Ropa en el servicio Clínico</li>
                                                    @endif
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-group">
                                                    @php
                                                        $hayRopaLimpia = false;
                                                    @endphp
                                                    @foreach($clinico->ropas as $ropa)
                                                                            @if ($ropa->pivot->estado == 'limpia' && $ropa->pivot->cantidad > 0)
                                                                                                    <li class="list-inline-item text-nowrap">
                                                                                                        <strong>></strong> {{ $ropa->tipo }} - Cantidad: {{ $ropa->pivot->cantidad }}
                                                                                                    </li>
                                                                                                    @php
                                                                                                        $hayRopaLimpia = true;
                                                                                                    @endphp
                                                                            @endif
                                                    @endforeach

                                                    @if (!$hayRopaLimpia)
                                                        <li class="list-inline-item">No Existe Ropa en el servicio Clínico</li>
                                                    @endif
                                                </ul>
                                            </td>
                                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="ServiciosEscazes" class="e my-3 w-100 rounded-3  ">
        @if(Auth::user()->isAdmin)
            <div class="d-flex align-items-center justify-content-between">
                <span>Servicios Con Escasez de Ropa (Administrador)</span>
                <a href="{{ route('NotificacionEscasez') }}" class="btn btn-light">Notificar a los Servicios Asociados Por
                    Email</a>
            </div>
            <div class="table-responsive my-3 rounded-3 shadow">

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>ID Servicio Clinico</th>
                            <th>Ropa Sucia</th>
                            <th>Ropa Limpia</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach(json_decode($serviciosConRopaBajaCantidad) as $clinico)
        <tr>
            <td>{{ $clinico->nombre }}</td>
            <td>{{ $clinico->id }}</td>
            <td>
                <ul class="list-group">
                    @php
                        $ropasMostradas = [];
                        $hayRopaSucia = false;
                    @endphp

                    @foreach($clinico->ropas as $ropa)
                        @if ($ropa->pivot->estado == 'sucia' && $ropa->pivot->cantidad >= 0)
                            @if (!in_array($ropa->tipo, $ropasMostradas))
                                <li class="text-nowrap list-inline-item">
                                    <strong>></strong> {{ $ropa->tipo }} - Cantidad: {{ $ropa->pivot->cantidad }}
                                    @if ($ropa->pivot->cantidad <= 10)
                                        <strong class="text-danger"> (Cantidad Baja)</strong>
                                    @endif
                                </li>
                                @php
                                    $ropasMostradas[] = $ropa->tipo;
                                    $hayRopaSucia = true;
                                @endphp
                            @endif
                        @endif
                    @endforeach

                    @if (!$hayRopaSucia)
                        <li class="list-inline-item">No Existe Ropa Sucia Asociada Al Ingreso<span class="text-danger fw-bold"> (Cantidad Muy Baja)</span></li>
                    @endif
                </ul>
            </td>
            <td>
                <ul class="list-group">
                    @php
                        $hayRopaLimpia = false;
                    @endphp

                    @foreach($clinico->ropas as $ropa)
                        @if ($ropa->pivot->estado == 'limpia' && $ropa->pivot->cantidad >= 0)
                            <li class="list-inline-item text-nowrap">
                                <strong>></strong> {{ $ropa->tipo }} - Cantidad: {{ $ropa->pivot->cantidad }}
                                @if ($ropa->pivot->cantidad <= 10)
                                    <strong class="text-danger"> (Cantidad Baja)</strong>
                                @endif
                            </li>
                            @php
                                $hayRopaLimpia = true;
                            @endphp
                        @endif
                    @endforeach

                    @if (!$hayRopaLimpia)
                        <li class="list-inline-item text-nowrap">No Existe Ropa Limpia Asociada Al Ingreso</li>
                    @endif
                </ul>
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

    <div id="IngresosDisponibles" class="w-100 my-3 rounded-3 ">
        <span>Ingresos Disponibles Asociados</span>
        <div class="table-responsive my-3 rounded-3 shadow">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Servicio Entrante</th>
                        <th>ID Ingreso</th>
                        <th>Ropa Sucia</th>
                        <th>Ropa Limpia</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(json_decode($ingresosServicioClinico) as $clinico)
                                        <tr>
                                            <td>{{ $clinico->sEntrante }}</td>
                                            <td>{{ $clinico->id }}</td>
                                            <td>
                                                <ul class="list-group">
                                                    @php
                                                        $hayRopaSucia = false;
                                                    @endphp
                                                    @foreach($clinico->ropas as $ropa)
                                                                            @if ($ropa->pivot->estado == 'sucia' && $ropa->pivot->cantidad > 0)
                                                                                                    <li class="text-nowrap list-inline-item ">
                                                                                                        <strong>></strong> {{ $ropa->tipo }} - Cantidad: <strong
                                                                                                            class="text-success fw-bold">+ {{ $ropa->pivot->cantidad }}</strong>
                                                                                                    </li>
                                                                                                    @php
                                                                                                        $hayRopaSucia = true;
                                                                                                    @endphp
                                                                            @endif
                                                    @endforeach
                                                    @if (!$hayRopaSucia)
                                                        <li class="list-inline-item">No Existe Ropa Sucia Asociada Al Ingreso </li>
                                                    @endif
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-group">
                                                    @php
                                                        $hayRopaLimpia = false;
                                                    @endphp

                                                    @foreach($clinico->ropas as $ropa)
                                                                            @if ($ropa->pivot->estado == 'limpia' && $ropa->pivot->cantidad > 0)
                                                                                                    <li class="list-inline-item text-nowrap">
                                                                                                        <strong>></strong> {{ $ropa->tipo }} - Cantidad: {{ $ropa->pivot->cantidad }}
                                                                                                    </li>
                                                                                                    @php
                                                                                                        $hayRopaLimpia = true;
                                                                                                    @endphp
                                                                            @endif
                                                    @endforeach

                                                    @if (!$hayRopaLimpia)
                                                        <li class="list-inline-item text-nowrap">No Existe Ropa Limpia Asociada Al Ingreso</li>
                                                    @endif
                                                </ul>
                                            </td>

                                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="MovimientoAsociados" class=" my-3 rounded-3 table-responsive  ">
        <span>Movimientos Realizados Asociados </span>
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
                                                @if( \Carbon\Carbon::parse($clinico->created_at)->format('d/m')  == \Carbon\Carbon::parse(now())->format('d/m'))
                                                    <span >Hoy a las {{Carbon\Carbon::parse($clinico->created_at)->format('H:i')}}</span>
                                                    @elseif(\Carbon\Carbon::parse($clinico->created_at)->format('d/m'))

                                                @else
                                                <span class="text-capitalize">{{\Carbon\Carbon::parse($clinico->created_at)->translatedFormat('D/m/y')}} a las {{Carbon\Carbon::parse($clinico->created_at)->format('H:i A')}}</span>
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
                                                                                                    <li class="list-inline-item text-nowrap"><strong>></strong> {{ $ropa->tipo }} -
                                                                                                        Cantidad: {{ $ropa->pivot->cantidad }}</li>
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
                                                                                                    <li class="list-inline-item text-nowrap"><strong>></strong> {{ $ropa->tipo }} -
                                                                                                        Cantidad: {{ $ropa->pivot->cantidad }}</li>
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
</div>
@endsection