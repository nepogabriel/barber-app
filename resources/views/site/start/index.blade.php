<x-layout_site_home title="Início">
    <section id="start">
        <div class="container d-flex align-items-center justify-content-center flex-column">
            <div class="slogan">
                <h1>Matenha seu corte limpo</h1>
            </div>
            <div class="container-btn-home">
                <a class="btn btn-layout border-2 border-dark" href="{{ route('site.service.index') }}">
                    <i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;&nbsp;Agendar Serviço
                </a>

                <a class="btn btn-outline-dark border-2" href="{{ route('site.start.check') }}">
                    <i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Consultar Agendamento
                </a>
            </div>
        </div>
    </section>

    <section id="about" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5 col-lg-7 d-flex justify-content-center flex-column">
                    <h2 class="mb-5">Sobre Nós</h2>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique temporibus in, vero expedita officia repellat dicta, nostrum natus, at sit facere doloribus illum et velit facilis debitis harum! Nemo, sequi.

                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, in.
                        
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga cumque quo quia nulla totam velit, cum placeat ipsa, dolore aut laudantium harum? Blanditiis quis facere quaerat doloribus neque dolorem asperiores.
                        
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga cumque quo quia nulla totam velit, cum placeat ipsa, dolore aut laudantium harum? Blanditiis quis facere quaerat doloribus neque dolorem asperiores.
                    </p>
                </div>

                <div class="col-sm-12 col-md-7 col-lg-5 d-flex justify-content-center align-items-center">
                    <div class="about-image">
                        <img src="/img/ft-barber-small.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section id="hours" class="pb-5">
        <div class="container">
            <h2 class="text-center mb-5">Horário de Funcionamento</h2>
            
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Segunda-feira:</strong>
                        <span>Fechado</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Terça-feira:</strong>
                        <span>09:00 - 12:00 / 13:30 - 18:00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Quarta-feira:</strong>
                        <span>09:00 - 12:00 / 13:00 - 18:00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Quinta-feira:</strong>
                        <span>09:00 - 12:00 / 13:00 - 18:00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Sexta-feira:</strong>
                        <span>09:00 - 12:00 / 13:00 - 18:00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Sábado:</strong>
                        <span>09:00 - 12:00 / 13:00 - 18:00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Domingo:</strong>
                        <span>Fechado</span>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}

    <section id="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3838.9174536412092!2d-48.04387968255621!3d-15.808306000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x935a3307e138fb2f%3A0x51649c7c01bbfd85!2sCol%C3%A9gio+Alub+Vicente+Pires+II!5e0!3m2!1spt-BR!2sbr!4v1564900228031!5m2!1spt-BR!2sbr" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>

    <footer id="footer">
        <div class="container py-5">
           <div class="row">
              <div class="col-sm-12 col-md-3 data-footer">
                <img class="logo-img-footer" src="/img/no_image.png" alt="Gabriel Ribeiro">
                <h3 class="mt-3">Nome da Loja</h3>
              </div>

              <div class="col-sm-12 col-md-3 data-footer">
                 <h3 class="title-footer">Redes Sociais</h3>

                 <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="#" class="social-media" target="_blank"><i class="fa fa-instagram fa-lg" aria-hidden="true"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="social-media" target="_blank"><i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="social-media" target="_blank"><i class="fa fa-whatsapp fa-lg" aria-hidden="true"></i></a>
                    </li>
                 </ul>
              </div>

              <div class="col-sm-12 col-md-3 data-footer">
                <h3 class="title-footer">Contatos</h3>

                <p><a href="tel://6133589999" class="contacts">(31) 98766-5331</a></p>
                <p><a href="tel://6133589999" class="contacts">(62) 98694-5980</a></p>
                <a href="https://api.whatsapp.com/send?phone=61 99359-8181&text=Ol%C3%A1%21+Gostaria+de+solicitar+um+atendimento" class="btn btn-success" target="_blank">
                    <i class="fa fa-whatsapp" aria-hidden="true"></i> Falar no Whatsapp
                </a>
              </div>

              <div class="col-sm-12 col-md-3 data-footer">
                 <h3 class="title-footer">Endereço</h3>

                 <p>QR 414, Conjunto M, Lote 01, Loja 01 - Samambaia Norte</p>
                 <p>Brasília - DF</p>
                 <p>72320-300</p>
              </div>
           </div>
        </div>

        <div class="copyright">
           <span>Copyright &copy; Todos os direitos reservados.</span>
        </div>

    </footer>

    <div class="fixed-buttons-container">
        <a href="https://api.whatsapp.com/send?phone=556133581011&amp;text=Ol%C3%A1%21+Gostaria+de+solicitar+um+atendimento" class="btn_fixed_whatsapp" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
</x-layout_site_home>