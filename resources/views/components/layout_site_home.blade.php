@include('components.header')
    <header id="container-navbar">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navbar-home">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <h1 class="logo_text">Gabriel Ribeiro</h1>
                    <img class="logo_img" src="/img/no_image.png" alt="Gabriel Ribeiro">
                </a>
                
                <button class="navbar-toggler menu-mobile-home" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse py-5" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#start">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#about">Sobre nós</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#map">Endereço</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#footer">Contato</a>
                    </li>
                    <li class="nav-item appointment">
                        <a class="nav-link" aria-current="page" href="{{ route('site.service.index') }}"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;Agendar</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

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
@include('components.footer')
