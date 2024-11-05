@extends('index')
@section('links')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')
<form method="POST" action="{{route('inicia-sesion')}}" id="form_login"
    class="d-flex flex-column justify-content-center align-items-center container gap-2 my-3">
    @csrf
    <img src="{{asset('icons/IconLavanaderia.svg')}}" alt="" width="40" height="40">
    <span class="fw-bold text-center">Iniciar Sesion En InventarioClinico</span>
    <div>
        <label for="id_username" class="form-label">Email</label>
        <input type="email" maxlength="150"
            required id="emailInput" name="email" class="form-control border-dark" placeholder="Tu Usuario">
    </div>
    <div>
        <label for="id_password" class="form-label">Contraseña</label>
        <input type="password" name="password" required 
            id="passwordInput" class="form-control border-dark" placeholder="Tu Contraseña">
    </div>
    <div class="form-check">
            <input type="checkbox" class="form-check-input" id="rememberCheck" name="remember">
            <label for="rememberCheck" class="form-check-label">Mantener Sesion Iniciada</label>
        </div>
    <button type="submit" class="btn btn-dark w-75 my-2 bg-black">Iniciar Sesion</button>
    <div class="d-flex flex-wrap gap-2 m-1 justify-content-around align-items-center" id="linksCuenta">
        <a href="" class="w-50 link-body-emphasis text-decoration-none fw-light fs-6">¿Olvidaste tu contraseña?</a>
        <a href="/registro" class=" flex-fill link-body-emphasis text-decoration-none fw-light fs-6">¿No tienes
            cuenta? Regístrate</a>
    </div>
</form>
@endsection