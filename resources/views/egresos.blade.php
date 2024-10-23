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
                    <select name="ServicioDesde" class="form-select" id="ssServicioDesde">
                        <option value="-1">Elige Servicio Clinico</option>
                        <option value="1">Pediatria</option>
                        <option value="2">Urgencias</option>
                    </select>
                </div>
                <div id="RopaSuciaLimpia"
                    class="bg-light justify-content-around d-flex align-items-center flex-wrap w-100 py-3">
                    <div id="ropaSucia">
                        <div id="title">
                            <span>Ropa Sucia</span>
                        </div>
                        <div
                            class=" d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3  flex-row ">
                            <div class="d-flex justify-content-center gap-3 ">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Sabanas</span>
                                    <span class="text-black-50" id="cantidadRopa">40 Unidades</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="ropaLimpia">
                        <div id="title">
                            <span>Ropa Limpia</span>
                        </div>
                        <div
                            class=" d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3 flex-row">
                            <div class="d-flex justify-content-center gap-3 ">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Sabanas</span>
                                    <span class="text-black-50" id="cantidadRopa">40 Unidades</span>
                                </div>

                            </div>
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
                <div id="RopaSuciaLimpia"
                    class="bg-light justify-content-between px-2 d-flex align-items-center flex-wrap w-100 py-3">
                    <div id="ropaSucia">
                        <div id="title">
                            <span>Ropa Sucia</span>
                        </div>
                        <div class="d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3 flex-row">
                            <div class="d-flex justify-content-center gap-3 ">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Sabanas</span>
                                    <span class="text-black-50" id="cantidadRopa">40 Unidades</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="ropaLimpia">
                        <div id="title">
                            <span>Ropa Limpia</span>
                        </div>
                        <div
                            class=" d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3 flex-row">
                            <div class="d-flex justify-content-center gap-3 ">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Camisetas</span>
                                    <span class="text-black-50" id="cantidadRopa">20 Unidades</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="d-flex flex-column text-start gap-0">
                                    <span>Sabanas</span>
                                    <span class="text-black-50" id="cantidadRopa">40 Unidades</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="cantidadesRopa" class="d-flex justify-content-evenly flex-row w-100 flex-fill container-fluid">
            <div id="limpiaContainer" class="bg-light flex-fill">
                <div id="titleRopalimpia">
                    <span>Ropa Limpia</span>
                </div>
                <div id="ropaLimpia" class="p-2 d-flex justify-content-start flex-wrap align-items-center gap-3">
                <div id="cantidadRopa" class="">
                        <label for="iSabanas" class="form-label">Sabanas</label>
                        <div class="d-flex justify-content-around align-items-center gap-2">
                        <input type="number" min="0" id="iSabanas" class="form-control text-center">
                        </div>
                    </div>
                    <div id="cantidadRopa" class="">
                        <label for="iSabanas" class="form-label">Sabanas</label>
                        <div class="d-flex justify-content-around align-items-center gap-2">
                        <input type="number" min="0" id="iSabanas" class="form-control text-center">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div id="suciaContainer" class="bg-light flex-fill">
                <div id="titleRopalimpia">
                    <span>Ropa Sucia</span>
                </div>
                <div id="ropaSucia" class="p-2 d-flex justify-content-start flex-wrap align-items-center gap-3">
                <div id="cantidadRopa" class="">
                        <label for="iSabanas" class="form-label">Sabanas</label>
                        <div class="d-flex justify-content-around align-items-center gap-2">
                        <input type="number" min="0" id="iSabanas" class="form-control text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="confirmarEgreso" class="w-100 d-flex justify-content-center align-items-center py-3">
        <a href="" class="btn btn-light w-75">Egresar</a>
    </div>
</div>

@endsection