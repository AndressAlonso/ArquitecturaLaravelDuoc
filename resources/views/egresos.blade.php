@extends('index') 

@section('links')
<link rel="stylesheet" href="{{ asset(path: 'css/egresos.css') }}">@endsection
@section('content')
<div class="d-flex justify-content-between gap-2">

    <div id="egresos" class="flex-fill d-flex flex-column justify-content-center">
        <div id="title" class="w-100 text-center fw-bold">
            <span class="fs-4">Egresar</span>
        </div>
        <div id="eDesde" class="d-flex flex-column gap-2">
            <div class="d-flex flex-column">
                <span>Egresar desde: </span>
                <select name="ServicioDesde" class="form-select" id="ssServicioDesde">
                    <option value="-1">Elige Servicio Clinico</option>
                    <option value="1">Pediatria</option>
                    <option value="2">Urgencias</option>
                </select>
            </div>
            <div class="bg-light">
                <div class=" d-flex justify-content-center align-items-center gap-3 container flex-wrap w-75">
                    <div class="d-flex justify-content-center gap-3 ">
                        <div class="d-flex flex-column text-start gap-0">
                            <span>Camisetas</span>
                            <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                        </div>
                        <input type="checkbox" name="camiseta" id="">
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <div class="d-flex flex-column text-start gap-0">
                            <span>Camisetas</span>
                            <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                        </div>
                        <input type="checkbox" name="camiseta" id="">
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <div class="d-flex flex-column text-start gap-0">
                            <span>Camisetas</span>
                            <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                        </div>
                        <input type="checkbox" name="camiseta" id="">
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <div class="d-flex flex-column text-start gap-0">
                            <span>Camisetas</span>
                            <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                        </div>
                        <input type="checkbox" name="camiseta" id="">
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <div class="d-flex flex-column text-start gap-0">
                            <span>Sabanas</span>
                            <span class="text-black-50" id="cantidadRopa">40 Unidades</span>
                        </div>
                        <input type="checkbox" name="camiseta" id="">
                    </div>
                </div>
            </div>

        </div>
        <div id="hEgreso" class="d-flex gap-2 flex-column">
            <div class="d-flex flex-column">
                <span>Egresar hacia: </span>
                <select name="ServicioDesde" class="form-select" id="ssServicioDesde">
                    <option value="-1">Elige Servicio Clinico</option>
                    <option value="1">Pediatria</option>
                    <option value="2">Urgencias</option>
                </select>
            </div>
            <div class="bg-light">
                <div class=" d-flex justify-content-center align-items-center gap-3 container flex-wrap w-75">
                    <div class="d-flex justify-content-center gap-3 ">
                        <div class="d-flex flex-column text-start gap-0">
                            <span>Camisetas</span>
                            <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                        </div>
                        <input type="checkbox" name="camiseta" id="">
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <div class="d-flex flex-column text-start gap-0">
                            <span>Camisetas</span>
                            <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                        </div>
                        <input type="checkbox" name="camiseta" id="">
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <div class="d-flex flex-column text-start gap-0">
                            <span>Camisetas</span>
                            <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                        </div>
                        <input type="checkbox" name="camiseta" id="">
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <div class="d-flex flex-column text-start gap-0">
                            <span>Camisetas</span>
                            <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                        </div>
                        <input type="checkbox" name="camiseta" id="">
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <div class="d-flex flex-column text-start gap-0">
                            <span>Sabanas</span>
                            <span class="text-black-50" id="cantidadRopa">40 Unidades</span>
                        </div>
                        <input type="checkbox" name="camiseta" id="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="cantidadesRopa" class="d-flex justify-content-around flex-column flex-fill">

        <div id="ropaLimpia" class="bg-light p-3">
            <div id="titleRopaLimpia" class="d-flex justify-content-between">
                <span>Ropa Sucia</span>
                <img width="25" height="25" src="{{ asset(path: 'icons/ropaLimpia.svg') }}" alt="">
            </div>
            <div>
                <label for="iSabanas" class="form-label">Sabanas</label>
                <input type="text" id="iSabanas" class="form-control w-75">
            </div>
            <div>
                <label for="iCamisetas" class="form-label">Camisetas</label>
                <input type="text" id="iCamisetas" class="form-control">
            </div>
        </div>
        <div id="ropaSucia" class="bg-light p-3">
            <div id="titleRopaSucia" class="d-flex justify-content-between">
                <span>Ropa Sucia</span>
                <img width="25" height="25" src="{{ asset(path: 'icons/ropaSucia.svg') }}" alt="">
            </div>
            <div>
                <label for="iSabanas" class="form-label">Sabanas</label>
                <input type="text" id="iSabanas" class="form-control">
            </div>
            <div>
                <label for="iCamisetas" class="form-label">Camisetas</label>
                <input type="text" id="iCamisetas" class="form-control">
            </div>
        </div>
    </div>
</div>

@endsection