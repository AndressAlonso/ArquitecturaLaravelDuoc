<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Escasez de Ropa</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <h1>Estimado,</h1>
    <p>Se ha detectado escasez de ropa en los siguientes servicios clínicos asociados a usted:</p>
    <div class="table-responsive my-3 rounded-3 shadow">
        <div>
            <span>Servicios con Ropa en Baja Cantidad</span>
        </div>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nombre del Servicio</th>
                    <th>Ropas con Baja Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->nombre }}</td>
                        <td>
                            <ul class="list-group">
                                @foreach ($servicio->ropas as $ropa)
                                    @if ($ropa->pivot->cantidad < 10)
                                        <li>{{ $ropa->tipo }}: {{ $ropa->pivot->cantidad }} unidades</li>
                                    @endif
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <ul>
        <li><strong>Realizar un egreso de ropa:</strong> Revisar el inventario disponible y proceder con la distribución necesaria para suplir la demanda inmediata.</li>
        <li><strong>Contactar al administrador:</strong> Coordinar con la administración para evaluar alternativas y gestionar soluciones eficaces.</li>
        <li><strong>Establecer egresos entre servicios asociados:</strong> Implementar un esquema de apoyo entre servicios clínicos relacionados para optimizar la distribución de los recursos disponibles.</li>
    </ul></body>
</html>
