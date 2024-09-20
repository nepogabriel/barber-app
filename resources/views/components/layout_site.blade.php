@include('components.header')
    <div class="container-fluid py-3 mb-3 bg-menu">
        <div class="container d-flex justify-content-between align-items-center">

            <div>
                {{-- <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                    +
                </button> --}}
            </div>

            <div>
{{--                <img src="img/logo.jpeg" height="100px" width="auto">--}}
                {{-- <img src="https://velhahistoriabarbearia.com.br/public/img/logo.jpg" height="100px" width="auto"> --}}
                <img src="{{ $logo_header }}" height="100px" width="auto">
            </div>

            <div>
                {{-- WPP --}}
            </div>
        </div>

        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
                {{-- <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">MENU</h5> --}}
                <img src="/img/logo.jpeg" height="70px" width="auto">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.professional.index') }}">Profissionais</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.service.index') }}">Serviços</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.hour.index') }}">Horários</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Configurações</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <h2 class="d-flex justify-content-center mb-4">{{ $title }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}
    </div>
@include('components.footer')
