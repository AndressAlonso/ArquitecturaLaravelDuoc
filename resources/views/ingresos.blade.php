@extends('index')
@section('content')
<div class="d-flex flex-column">
    <div class="d-flex justify-content-between gap-2 flex-column flex-wrap container ">
        <div id="DatosServicioClinico" class="flex-fill d-flex flex-column justify-content-center">
            <div id="title" class="w-100 text-center fw-bold">
                <span class="fs-4">Ingresos</span>
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
              <button type="submit">Ingresar</button>
            </form>
        </div>
       
    </div>
</div>

@endsection