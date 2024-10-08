<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario Ropa Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset(path: 'css/app.css') }}">
    @yield(section: 'links')
</head>
  
<body data-bs-theme="light">
  <nav class="navbar border-bottom border-body navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="{{asset('icons/IconLavanaderia.svg')}}" alt="Logo" width="30" height="24"
          class="d-inline-block align-text-top">
       Lavanderia
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Egresos/Ingresos
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Ingresos de Ropa</a></li>
              <li><a class="dropdown-item" href="#">Ingresos de Ropa</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Reportes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sobre Nosotros</a>
          </li>
        </ul>
        <div>
          <span class="fw-bold">Usuario Conectado!</span>
        </div>
      </div>
    </div>
  </nav>
  <main class="container-fluid">
  @yield('content')
  </main>
  <div class="card text-center">
    <div class="card-header">
     
    </div>
    <div class="card-body">
      <h5 class="card-title">Footer</h5>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>