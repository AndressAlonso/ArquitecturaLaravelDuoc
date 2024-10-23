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
                    <select name="ServicioDesde" class="form-select" id="ssServicioDesde">
                        <option value="-1">Elige Servicio Clinico</option>
                        <option value="1">Pediatria</option>
                        <option value="2">Urgencias</option>
                    </select>
                </div>
                <div>
                    <span class="text-black-50">Ropa Disponible en Servicio Clinico</span>
                </div>
                <div id="RopaSuciaLimpia"
                    class="bg-light justify-content-around d-flex align-items-center flex-wrap w-100">
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
                <div class="w-100 d-flex gap-1 justify-content-end px-2 align-items-end">
                    <span>En Total</span> :<span>120</span>
                </div>
            </div>
        </div>
        <div id="ingresosEntrantes" class="flex-fill d-flex flex-column justify-content-center">
            <div id="title" class="py-2">
                <span class="text-black-50">Ingresos restantes</span>
            </div>
            <div class="d-flex flex-column gap-3  w-100">
                <div
                    class="d-flex flex-grow-1 flex-column justify-content-between border border-dark-subtle rounded-2 border-1 container container shadow">
                    <div class="d-flex w-100 py-2 justify-content-between flex-wrap">
                        <span style="font-size: small;" class="fw-semibold">22/10/2024</span>
                        <div>
                            <span class="fw-semibold">Total 120</span>
                            <span class="fw-semibold text-success">+ 50 </span>
                        </div>
                    </div>
                    <div class="border border-dark-subtle border-1"></div>
                    <div class="d-flex flex-column">
                        <div>
                            <div class="d-flex">
                                <div>
                                    <img src="{{asset('icons/IconLavanaderia.svg')}}" width="50" height="50" alt="Producto 1"
                                        style="max-width: 100px;" />
                                </div>
                                <div class="d-flex flex-column container my-auto">
                                    <div>
                                        <span class="text-capitalize fw-bold">Servicio Clinico</span>
                                        <span class="text-capitalize text-success fw-bold">Entrante</span>
                                    </div>
                                    <span class="text-black-50"></span>
                                    <div id="RopaSuciaLimpia"
                                        class="bg-light justify-content-around flex-column d-flex align-items-start flex-wrap w-100">
                                        <div id="ropaSucia">
                                            <div id="title">
                                                <span>Ropa Sucia</span>
                                            </div>
                                            <div
                                                class=" d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3  flex-row ">
                                                <div class="d-flex justify-content-center gap-3 ">
                                                    <div class="d-flex flex-column text-start gap-0">
                                                        <span>Camisetas</span>
                                                        <div>
                                                            <span class="text-black-50" id="cantidadRopa">20
                                                                Unidades</span>
                                                            <span class="text-success fw-bold" id="cantidadRopa">+
                                                                14
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center gap-3 ">
                                                    <div class="d-flex flex-column text-start gap-0">
                                                        <span>Camisetas</span>
                                                        <div>
                                                            <span class="text-black-50" id="cantidadRopa">20
                                                                Unidades</span>
                                                            <span class="text-success fw-bold" id="cantidadRopa">+
                                                                14
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center gap-3 ">
                                                    <div class="d-flex flex-column text-start gap-0">
                                                        <span>Camisetas</span>
                                                        <div>
                                                            <span class="text-black-50" id="cantidadRopa">20
                                                                Unidades</span>
                                                            <span class="text-success fw-bold" id="cantidadRopa">+
                                                                14
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div id="ropaLimpia">
                                            <div id="title">
                                                <span>Ropa Limpia</span>
                                            </div>
                                            <div
                                                class="d-flex justify-content-start flex-fill flex-wrap align-items-center gap-3 flex-row">
                                                <div class="d-flex justify-content-center gap-3 ">
                                                    <div class="d-flex flex-column text-start gap-0">
                                                        <span>Camisetas</span>
                                                        <div>
                                                            <span class="text-black-50" id="cantidadRopa">20
                                                                Unidades</span>
                                                            <span class="text-success fw-bold" id="cantidadRopa">+
                                                                14
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center gap-3 ">
                                                    <div class="d-flex flex-column text-start gap-0">
                                                        <span>Camisetas</span>
                                                        <div>
                                                            <span class="text-black-50" id="cantidadRopa">20
                                                                Unidades</span>
                                                            <span class="text-success fw-bold" id="cantidadRopa">+
                                                                14
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center gap-3 ">
                                                    <div class="d-flex flex-column text-start gap-0">
                                                        <span>Camisetas</span>
                                                        <div>
                                                            <span class="text-black-50" id="cantidadRopa">20
                                                                Unidades</span>
                                                            <span class="text-success fw-bold" id="cantidadRopa">+
                                                                14
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-auto gap-2 py-2">
                            <a href="" class="btn btn-success">Confirmar Ingreso</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection