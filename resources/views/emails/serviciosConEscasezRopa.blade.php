<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                @foreach(json_decode($serviciosConRopaBajaCantidad) as $clinico)
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
    
</body>
</html>