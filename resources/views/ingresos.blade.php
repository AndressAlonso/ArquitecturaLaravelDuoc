@extends('index')
@section('content')
<div class="d-flex flex-column">
    <div class="d-flex justify-content-between gap-2 flex-column flex-wrap container ">
        <div id="DatosServicioClinico" class="flex-fill d-flex flex-column justify-content-center">
            <div id="title" class="w-100 text-end p-1">
                <span class="">Ingresos-Consulta</span>
            </div>
            <form method="post" action="{{route('ingresos2')}}" id="eDesde" class="d-flex flex-column gap-2">
                @csrf
                <div class="d-flex flex-column">
                    <span>Ingresar en: </span>
                    <select name="ServicioDesde" class="form-select" id="ssServicioDesde">
                        <option value="-1">Elige Servicio Clinico</option>
                        @foreach ($serviciosClinicosusuario as $clinico )
                            <option value="{{ $clinico['id'] }}">{{ $clinico['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>
              <div class="w-100 d-flex justify-content-center align-items-center my-2">
              <button type="submit" class="btn btn-light w-75">Ingresar</button>
              </div>


              <span class="fw-bold">Ingresos de Ropa Disponibles</span>

              <div class="table-responsive my-3 rounded-3 shadow">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Servicio Entrante</th>
                <th>ID Ingreso</th>
                <th>Ropa Sucia</th>
                <th>Ropa Limpia</th>
                 <!-- Nueva columna para ingresos -->
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
                                <li class="list-inline-item">No Existe Ropa Limpia Asociada Al Ingreso</li>
                            @endif
                        </ul>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

            </form>
        </div>
       
    </div>
</div>

@endsection