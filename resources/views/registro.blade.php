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
        <label for="userInput" class="form-label">Usuario</label>
        <input type="text" required name="name" id="userInput" class="form-control "
            placeholder="Tu Usuario">
    </div>
    <div>
        <label for="passwordInput" class="form-label">Contraseña</label>
        <input type="password" name="password" required name="password" id="passwordInput"
            class="form-control " placeholder="Tu Contraseña">
    </div>
    <div>
        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" class="form-control " id="password_confirmation" placeholder="Confirma tu Contraseña" required>
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