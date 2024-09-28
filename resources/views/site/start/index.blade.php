<x-layout_site_home title="Início">
    <section class="start">
        <div class="container d-flex align-items-center justify-content-center flex-column">
            <div class="slogan">
                <h1>Matenha seu corte limpo</h1>
            </div>
            <div class="container-btn-home">
                <a class="btn btn-bege border-2 border-dark" href="{{ route('site.service.index') }}">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;&nbsp;Agendar Serviço
                </a>

                <a class="btn btn-outline-dark border-2" href="{{ route('site.start.check') }}">
                    <i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Consultar Agendamento
                </a>
            </div>
        </div>
    </section>

    <section id="about">
        ABOUT
    </section>
</x-layout_site_home>