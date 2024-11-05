@extends('index') 

@section('links')
<link rel="stylesheet" href="{{ asset(path: 'css/egresos.css') }}">@endsection
@section('content')
<form method="post" action="{{ route('egresos2') }}" class="d-flex flex-column container">
    @csrf
    <div class="d-flex justify-content-center flex-column ">
        <div id="egresos" class="d-flex flex-column justify-content-center container-fluid">
            <div id="title" class="w-100 text-end p-1">
                <span class="">Egresar-Consulta</span>
            </div>
            <div id="eDesde" class="d-flex flex-column gap-2">
                <div class="d-flex flex-column">
                    <span>Egresar desde: </span>
                    <select name="ServicioDesde" class="form-select" id="ssServicioDesde">
                        <option value="-1">Elige Servicio Clínico</option>
                        @foreach (json_decode($serviciosClinicosusuario) as $clinicos)
                            <option value="{{ $clinicos->id }}">{{ $clinicos->nombre }}
                            @if ($clinicos->IsLavanderia)->Lavanderia
                            @endif
                            </option>
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
                            <option value="{{ $clinicos->id }}">{{ $clinicos->nombre }}
                                @if ($clinicos->IsLavanderia)->Lavanderia 
                                @endif 
                            </option>
                        @endforeach
                    </select>

                </div>

            </div>
        </div>
    </div>
    <div id="confirmarEgreso" class="w-100 d-flex justify-content-center align-items-center py-3">
        <button type="submit" class="btn btn-light w-75">Egresar</button>
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
                @foreach(json_decode($servicioClinicos) as $clinico)
                                <tr>
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
                                                <li class="list-inline-item">No Existe Ropa en el servicio Clinico</li>
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
                                                <li class="list-inline-item">No Existe Ropa en el servicio Clinico</li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</form>


@endsection