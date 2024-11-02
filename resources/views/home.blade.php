@extends('index')
@section('content')
<div class="d-flex flex-grow-1 gap-2 w-100 flex-wrap container">
    <span class="w-100 text-end p-1">Home</span>
    <div id="ServiciosClinicios" class="table-responsive w-100">
   <div class="d-flex flex-column ">
   <span>Tus Servicios Clínicos Asociados</span>
   <span class="text-black-50">Si uno de tus Servicios Clinicos Esta Marcado Es Porque Tiene Escasez de Algun Tipo de Ropa</span>
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
                @foreach(json_decode($serviciosClinicosusuario) as $clinico)
                    @php
                        $pocaCantidad = false;
                    @endphp
                    @foreach($clinico->ropas as $ropa)
                        @if ($ropa->pivot->cantidad < 10)
                        @php
                            $pocaCantidad = true;
                        @endphp
                        @endif
                    @endforeach
                    <tr class="{{ $pocaCantidad ? 'table-danger' : '' }}">
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

<div id="IngresosDisponibles" class="table-responsive w-100">
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
                                        <strong>></strong> {{ $ropa->tipo }} - Cantidad: <strong class="text-success fw-bold">+ {{ $ropa->pivot->cantidad }}</strong>
                                    </li>
                                    @php
                                        $hayRopaSucia = true;
                                    @endphp
                                @endif
                            @endforeach
                            @if (!$hayRopaSucia)
                                <li class="list-inline-item">No Existe Ropa Sucia Asociada Al Ingreso</li>
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
<div id="Movimiento Asociados" class="table-responsive w-100">
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
                    <td>{{ \Carbon\Carbon::parse($clinico->created_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ $clinico->tipoMovimiento }}</td>
                    <td>
                        <ul class="list-group">
                            @php
                                $hayRopaSucia = false;
                            @endphp
                            @foreach ($clinico->ropas as $ropa)
                                @if ($ropa->pivot->estado == 'sucia' && $ropa->pivot->cantidad > 0)
                                    <li class="list-inline-item text-nowrap"><strong>></strong> {{ $ropa->tipo }} - Cantidad: {{ $ropa->pivot->cantidad }}</li>
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
                                    <li class="list-inline-item text-nowrap"><strong>></strong> {{ $ropa->tipo }} - Cantidad: {{ $ropa->pivot->cantidad }}</li>
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