@extends('index') 

@section('links')
<link rel="stylesheet" href="{{ asset(path: 'css/egresos.css') }}">@endsection
@section('content')
<div class="d-flex flex-column container">
    <div class="d-flex justify-content-center flex-column ">
        <div id="egresos" class="d-flex flex-column justify-content-center container-fluid">
            <div id="title" class="w-100 text-center fw-bold">
                <span class="fs-4">Egresar</span>
            </div>
            <div id="eDesde" class="d-flex flex-column gap-2">
                <div class="d-flex flex-column">
                    <span>Egresar desde: </span>
                    <select name="ServicioDesde" class="form-select" disabled id="ssServicioDesde">
                        <option value="{{ $servicioClinico1->id }}">{{ $servicioClinico1->nombre }}</option>
                    </select>
                </div>
                <div id="RopaSuciaLimpia"
                    class="bg-light justify-content-around container gap-3 d-flex align-items-center flex-wrap w-100 py-3">
                    <div id="ropaSucia" class="flex-fill">
                        <div id="title">
                            <span>Ropa Sucia</span>
                        </div>
                        <div
                            class=" d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3  flex-row ">

                            @foreach ($servicioClinico1->ropas as $ropa)
                                @if ($ropa->pivot->estado == 'sucia')
                                    <div class="d-flex justify-content-center gap-3">
                                        <div class="d-flex flex-column w-100 text-start gap-0">
                                            <span>{{$ropa->tipo}}</span>
                                            <span class="text-black-50 w-100" id="cantidadRopa">{{ $ropa->pivot->cantidad }}
                                                Unidades</span>

                                        </div>
                                    </div>
                                @endif
                            @endforeach


                        </div>
                    </div>
                    <div id="ropaLimpia" class="flex-fill">
                        <div id="title">
                            <span>Ropa Limpia</span>
                        </div>
                        <div
                            class=" d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3 flex-row">

                            @foreach ($servicioClinico1->ropas as $ropa)
                                @if ($ropa->pivot->estado == 'limpia')
                                    <div class="d-flex flex-fill justify-content-center gap-3 ">
                                        <div class="d-flex flex-fill flex-column text-start gap-0">
                                            <span>{{$ropa->tipo}}</span>
                                            <span class="text-black-50 w-100" id="cantidadRopa">{{ $ropa->pivot->cantidad }}
                                                Unidades</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach


                        </div>
                    </div>

                </div>
            </div>
            <div id="hEgreso" class="d-flex gap-2 flex-column">
                <div class="d-flex flex-column">
                    <span>Egresar hacia: </span>
                    <select name="ServicioDesde" disabled class="form-select" id="ssServicioDesde">
                        <option value="{{ $servicioClinico2->id }}">{{ $servicioClinico2->nombre }}</option>
                    </select>
                </div>
                <div id="RopaSuciaLimpia"
                    class="bg-light justify-content-between px-2 d-flex align-items-center flex-wrap w-100 py-3">
                    <div id="ropaSucia" class="flex-fill">
                        <div id="title">
                            <span>Ropa Sucia</span>
                        </div>
                        <div class="d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3 flex-row">

                            @foreach ($servicioClinico2->ropas as $ropa)
                                @if ($ropa->pivot->estado == 'sucia')
                                    <div class="d-flex flex-fill justify-content-center gap-3 ">
                                        <div class="d-flex flex-fill flex-column text-start gap-0">
                                            <span>{{$ropa->tipo}}</span>
                                            <span class="text-black-50 w-100" id="cantidadRopa">{{ $ropa->pivot->cantidad }}
                                                Unidades</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="ropaLimpia" class="flex-fill">
                        <div id="title">
                            <span>Ropa Limpia</span>
                        </div>
                        <div
                            class=" d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3 flex-row">

                            @foreach ($servicioClinico2->ropas as $ropa)
                                @if ($ropa->pivot->estado == 'limpia')
                                    <div class="d-flex flex-fill justify-content-center gap-3 ">
                                        <div class="d-flex flex-fill flex-column text-start gap-0">
                                            <span>{{$ropa->tipo}}</span>
                                            <span class="text-black-50 w-100" id="cantidadRopa">{{ $ropa->pivot->cantidad }}
                                                Unidades</span>

                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="cantidadesRopa" method="POST" action="{{ route('egresarRopas') }}"
            class="d-flex justify-content-evenly flex-column gap-2 w-100 flex-fill container-fluid">
            @csrf
            <div id="limpiaContainer" class="flex-fill">
                <div id="titleRopalimpia">
                    <span>Ropa Sucia</span>
                </div>
                <div id="ropaLimpia"
                    class="bg-light p-2 d-flex justify-content-start flex-wrap align-items-center gap-3">
                    @foreach ($servicioClinico1->ropas as $ropa)
                        @if ($ropa->pivot->estado == 'sucia')
                            <div id="cantidadRopa" class="">
                                <label for="cantidad{{$ropa->id}}sucia" class="form-label">{{$ropa->tipo}}</label>
                                <div class="d-flex justify-content-around align-items-center gap-2">
                                    <input type="number" min="0" max="{{ intval($ropa->pivot->cantidad) }}"
                                        id="cantidad{{$ropa->id}}sucia" class="form-control text-center"
                                        name="ropas[{{$ropa->id}}][cantidad]" value="0">
                                    <input type="hidden" name="ropas[{{$ropa->id}}][tipo]" value="{{$ropa->tipo}}">
                                    <input type="hidden" name="ropas[{{$ropa->id}}][estado]" value="sucia">
                                    <!-- Estado agregado aquí -->
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div id="suciaContainer" class="flex-fill">
                <div id="titleRopalimpia">
                    <span>Ropa Limpia</span>
                </div>
                <div id="ropaSucia"
                    class="bg-light p-2 d-flex justify-content-start flex-wrap align-items-center gap-3">
                    @foreach ($servicioClinico1->ropas as $ropa)
                        @if ($ropa->pivot->estado == 'limpia')
                            <div id="cantidadRopa" class="">
                                <label for="cantidad{{$ropa->id}}limpia" class="form-label">{{$ropa->tipo}}</label>
                                <div class="d-flex justify-content-around align-items-center gap-2">
                                    <input type="number" min="0" max="{{ intval($ropa->pivot->cantidad) }}"
                                        id="cantidad{{$ropa->id}}limpia" class="form-control text-center"
                                        name="ropas[{{$ropa->id}}][cantidad]" value="0">
                                    <input type="hidden" name="ropas[{{$ropa->id}}][tipo]" value="{{$ropa->tipo}}">
                                    <input type="hidden" name="ropas[{{$ropa->id}}][estado]" value="limpia">
                                    <!-- Estado agregado aquí -->
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div id="confirmarEgreso" class="w-100 d-flex justify-content-center align-items-center py-3">
                <input type="hidden" name="sClinico1" value="{{$servicioClinico1}}">
                <input type="hidden" name="sClinico2" value="{{$servicioClinico2}}">
                <button type="submit" class="btn btn-light w-75">Egresar</button>
            </div>
        </form>


    </div>

</div>

@endsection