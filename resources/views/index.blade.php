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
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toastEl = document.getElementById('liveToast');
    if (toastEl) {
      const toast = new bootstrap.Toast(toastEl);
      toast.show();
    }
  });
</script>

<body data-bs-theme="light">
  <div class="toast-container bottom-0 start-50 translate-middle-x position-fixed bottom-0 end-0 p-3">
    @if (session('success'))
    <div class="toast bg-dark" id="liveToast">
      <div class="toast-body text-white text-capitalize">
      {{ session('success') }}
      </div>
    </div>
  @elseif (session('error'))
  <div class="toast bg-danger" id="liveToast">
    <div class="toast-body text-white">
    {{ session('error') }}
    </div>
        
  @endif
    </div>
  </div>
    <nav class="navbar border-bottom border-body navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">
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
              <a class="nav-link" aria-current="page" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Egresos/Ingresos
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('egresos')}}">Egresos</a></li>
                <li><a class="dropdown-item" href="{{route('ingresos')}}">Ingresos</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Reportes</a>
            </li>
          </ul>
          <div class="ps-md-4">
            @auth
        <span class="fw-bold text-capitalize">{{Auth::user()->name}}</span>
        <a href="{{route('logout')}}" class="btn btn-outline-light border-0">
          <svg id="svg1144" class="px-1" width="30" height="30" viewBox="0 0 8.4666667 8.4666667"
          xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
          <g id="layer2">
            <path id="path826"
            d="m3.4384463 0c-.441327 0-.7926521.35755987-.7926521.79271966v2.11717904c0 .36078.5291234.36078.5291234 0v-2.11717904c0-.15114992.1196186-.26354987.2635287-.26354987h4.2355699c.1511424 0 .2635271.12272995.2635271.26354987v6.88122714c0 .14289-.1123847.2635499-.2635271.2635499h-4.2355699c-.1511445 0-.2635287-.1206599-.2635287-.2635499v-2.1171792c0-.3502899-.5291234-.3554497-.5291234 0v2.1171792c0 .4403297.3575268.7927196.7926521.7927196h4.2355699c.4351252 0 .7926505-.3523899.7926505-.7927196v-6.88122714c0-.43515979-.3523589-.79271966-.7926505-.79271966zm-2.0389849 2.7243988-1.32229164 1.3223995c-.10289302.1029015-.10289301.2702083 0 .3731098l1.32229164 1.3223995c.2500934.2501199.6252338-.1250598.3751403-.3751699l-.87067673-.8691995h4.65359753c.3524042 0 .3524042-.5291698 0-.5291698h-4.65204766l.86912686-.8691897c.2485863-.2692845-.1298358-.6156529-.3751403-.3751799z"
            font-variant-ligatures="normal" font-variant-position="normal" font-variant-caps="normal"
            font-variant-numeric="normal" font-variant-alternates="normal" font-feature-settings="normal"
            text-indent="0" text-align="start" text-decoration-line="none" text-decoration-style="solid"
            text-decoration-color="rgb(0,0,0)" text-transform="none" text-orientation="mixed"
            white-space="normal" shape-padding="0" isolation="auto" mix-blend-mode="normal"
            solid-color="rgb(0,0,0)" solid-opacity="1" vector-effect="none" />
          </g>
          </svg>
        </a>
      @else
    <a href="{{route('login')}}" class="btn btn-light">Iniciar Sesion</a>
    <a href="{{route('registro')}}" class="btn btn-light">Registrarse</a>
  @endauth
          </div>
        </div>
      </div>
    </nav>
    @yield('content')
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