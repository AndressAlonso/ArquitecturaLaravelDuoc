@extends('index')
@section('content')
<div class="d-flex flex-column">
    <div class="d-flex justify-content-between gap-2 flex-column flex-wrap container ">
        <div id="DatosServicioClinico" class="flex-fill d-flex flex-column justify-content-center">
            <div id="title" class="w-100 text-center fw-bold">
                <span class="fs-4">Ingresos</span>
            </div>
            <div id="eDesde" class="d-flex flex-column gap-2">
                <div class="d-flex flex-column">
                    <span>Ingresar en: </span>
                    <select name="ServicioDesde" disabled class="form-select" id="ssServicioDesde">
                        <option value="-1">{{$servicioClinicoarray['nombre']}}</option>

                    </select>
                </div>
                <div>
                    <span class="text-black-50">Ropa Disponible en {{$servicioClinicoarray['nombre']}}</span>
                </div>
                <div id="RopaSuciaLimpia"
                    class="bg-light justify-content-around d-flex align-items-center flex-wrap w-100">
                    <div id="ropaSucia">
                        <div id="title">
                            <span>Ropa Sucia</span>
                        </div>
                        <div class="d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3 flex-row">
                            @foreach ($servicioClinicoarray['ropas'] as $ropa)
                                @if ($ropa['pivot']['estado'] == 'sucia')
                                    <div class="d-flex justify-content-center gap-3">
                                        <div class="d-flex flex-column text-start gap-0">
                                            <span>{{ $ropa['tipo'] }}</span>
                                            <span class="text-success" id="cantidadRopa">{{ $ropa['pivot']['cantidad'] }}
                                                Unidades</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div id="ropaLimpia">
                        <div id="title">
                            <span>Ropa Limpia</span>
                        </div>
                        <div class="d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3 flex-row">
                            @foreach ($servicioClinicoarray['ropas'] as $ropa)
                                @if ($ropa['pivot']['estado'] == 'limpia')
                                    <div class="d-flex justify-content-center gap-3">
                                        <div class="d-flex flex-column text-start gap-0">
                                            <span>{{ $ropa['tipo'] }}</span>
                                            <span class="text-success" id="cantidadRopa">{{ $ropa['pivot']['cantidad'] }}
                                                Unidades</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="w-100 d-flex gap-1 justify-content-end px-2 align-items-end">
                    <span>En Total</span>
                    :<span>{{ collect($servicioClinicoarray['ropas'])->sum('pivot.cantidad') }}</span>

                </div>

            </div>
        </div>
        <div id="ingresosEntrantes" class="flex-fill d-flex flex-column justify-content-center">
            <div id="title" class="py-2">
                <span class="text-black-50">Ingresos restantes</span>
            </div>
            <div class="d-flex flex-column gap-3 w-100">
                @foreach ($ingresosServicioClinico as $ingreso)
                                <div
                                    class="d-flex flex-grow-1 flex-column justify-content-between border border-dark-subtle rounded-2 border-1 container shadow">
                                    <div class="d-flex w-100 py-2 justify-content-between flex-wrap">
                                        <span style="font-size: small;"
                                            class="fw-semibold">{{ \Carbon\Carbon::parse($ingreso['created_at'])->timezone('America/Santiago')->format('d/m/Y H:i') }}
                                        </span>

                                        <div>
                                            <span class="fw-bold text-success">Total Prendas:+
                                                {{ collect($ingreso['ropas'])->sum('pivot.cantidad') }}</span>

                                        </div>
                                    </div>

                                    <div class="border border-dark-subtle border-1"></div>

                                    <div class="d-flex flex-column">
                                        <div class="d-flex">
                                            <div>
                                                <img src="{{ asset('icons/IconLavanaderia.svg') }}" width="50" height="50"
                                                    alt="Producto" style="max-width: 100px;" />
                                            </div>
                                            <div class="d-flex flex-column container my-auto">
                                                <div>
                                                    <span class="text-capitalize fw-bold">Servicio Entrante:
                                                        {{ $ingreso['sEntrante'] }}</span>
                                                    <span class="text-capitalize fw-bold"> | Saliente:
                                                        {{ $ingreso['sSaliente'] }}</span>
                                                </div>

                                                <div id="RopaSuciaLimpia"
                                                    class="bg-light justify-content-around flex-column d-flex align-items-start flex-wrap w-100">
                                                    <!-- Mostrar Ropa Sucia -->
                                                    <div id="ropaSucia">
                                                        <div id="title">
                                                            <span class="fw-semibold">Ropa Sucia</span>
                                                        </div>
                                                        <div
                                                            class="d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3 flex-row">
                                                            @foreach ($ingreso['ropas'] as $ropa)
                                                                @if ($ropa['pivot']['estado'] == 'sucia')
                                                                    <div class="d-flex justify-content-center gap-3">
                                                                        <div class="d-flex flex-column text-start gap-0">
                                                                            <span>>{{ $ropa['tipo'] }}</span>
                                                                            <div>
                                                                                <span
                                                                                    class="text-success fw-bolder">+{{ $ropa['pivot']['cantidad'] }}
                                                                                    Unidades</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <!-- Mostrar Ropa Limpia -->
                                                    <div id="ropaLimpia">
                                                        <div id="title">
                                                            <span class="fw-semibold">Ropa Limpia</span>
                                                        </div>
                                                        <div
                                                            class="d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3 flex-row">
                                                            @foreach ($ingreso['ropas'] as $ropa)
                                                                @if ($ropa['pivot']['estado'] == 'limpia')
                                                                    <div class="d-flex justify-content-center gap-3">
                                                                        <div class="d-flex flex-column text-start gap-0">
                                                                            <span>>{{ $ropa['tipo'] }}</span>
                                                                            <div>
                                                                                <span
                                                                                    class="text-success fw-bolder">+{{ $ropa['pivot']['cantidad'] }}
                                                                                    Unidades</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex ms-auto gap-2 py-2">
                                            <form method="post" action="{{route('ingresarRopa')}}">
                                                @csrf
                                                @php
                                                    $ropaSuciaYLimpia = collect($ingreso['ropas']);
                                                @endphp
                                                <input type="hidden" name="ropas" value="{{$ropaSuciaYLimpia}}">
                                                <input type="hidden" name="sEntrante" value="{{$ingreso['sEntrante']}}">
                                                <input type="hidden" name="sSaliente" value="{{$ingreso['sSaliente']}}">
                                                <button type="submit" class="btn btn-success">Confirmar Ingreso</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                @endforeach

            </div>

        </div>
    </div>
</div>

@endsection