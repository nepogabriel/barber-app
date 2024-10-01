<x-layout_site_home title="Início">
    <section id="start">
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

    <section id="about" class="d-flex align-items-center my-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-7 d-flex justify-content-center flex-column">
                    <h3 class="mb-5">Sobre Nós</h3>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique temporibus in, vero expedita officia repellat dicta, nostrum natus, at sit facere doloribus illum et velit facilis debitis harum! Nemo, sequi.

                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, in.
                        
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga cumque quo quia nulla totam velit, cum placeat ipsa, dolore aut laudantium harum? Blanditiis quis facere quaerat doloribus neque dolorem asperiores.
                        
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga cumque quo quia nulla totam velit, cum placeat ipsa, dolore aut laudantium harum? Blanditiis quis facere quaerat doloribus neque dolorem asperiores.
                    </p>
                </div>

                <div class="col-sm-12 col-md-5">
                    <div class="about-image">
                        <img src="/img/foto2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="our-services">
        <div class="container">
            <div class="row">
                <div class="card" style="width: 18rem;">
                    <img src="/img/service-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                  </div>
            </div>
        </div>
    </section>
</x-layout_site_home>