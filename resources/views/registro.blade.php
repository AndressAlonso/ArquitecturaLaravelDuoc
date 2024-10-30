@extends('index')
@section('links')
<link rel="stylesheet" href=" {{asset('css/login.css')}} ">
@endsection
@section('content')
<form method="POST" action="{{route('validar-registro')}}" id="form_login"
    class="d-flex flex-column justify-content-center align-items-center container gap-2">
    @csrf
    <img src=" {{asset('icons/IconLavanaderia.svg')}} " alt="" width="40" height="40">
    <span class="fw-bold text-center">Registrarse en TechTreasure</span>
    <div>
        <label for="id_username" class="form-label">Email</label>
        <input type="email" autofocus="" autocapitalize="none" autocomplete="disable" maxlength="150" required
            id="emailInput" name="email" class="form-control " placeholder="Tu Email">
    </div>
    <div>
        <label for="userInput" class="form-label">Nombre</label>
        <input type="text" required name="fname" id="userInput" class="form-control " placeholder="Tu nombre">
    </div>
    <div>
        <label for="userInput" class="form-label">Apellido</label>
        <input type="text" required name="lname" id="userInput" class="form-control " placeholder="Tu apellido">
    </div>
    <div>
        <label for="passwordInput" class="form-label">Contraseña</label>
        <input type="password" name="password" required name="password" id="passwordInput" class="form-control "
            placeholder="Tu Contraseña">
    </div>
    <div>
        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" class="form-control " id="password_confirmation"
            placeholder="Confirma tu Contraseña" required>
    </div>
    <div>
        <label for="clinical_services">Servicios Clínicos Asociados:</label>
        <label for="clinical_services" class="helptext"> <span class="helptext">>Para marcar mas de un servicio Clinico Manten Presionado CTRL o Si estas en celular debes presionar dos veces para que se marque mas de una opcion</span></label>
        <select id="clinical_services" name="sClinicos[]" class="form-select" multiple required>
            <option value="pediatrics">Pediatría</option>
            <option value="cardiology">Cardiología</option>
            <option value="orthopedics">Ortopedia</option>
            <option value="neurology">Neurología</option>
        </select>
    </div>

    <ul class="errorlist text-center">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="submit" class="btn btn-dark my-3 bg-black w-75">Registrarse</button>
    <div class="d-flex flex-wrap gap-2 m-1 justify-content-around align-items-center" id="linksCuenta">
    </div>
</form>
@endsection