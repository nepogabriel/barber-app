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

    {{-- <section id="our-services">
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
    </section> --}}

    <section id="map">
        {{-- <div class="col-sm-12">
            <div class="mapa transparent"> --}}
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3838.9174536412092!2d-48.04387968255621!3d-15.808306000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x935a3307e138fb2f%3A0x51649c7c01bbfd85!2sCol%C3%A9gio+Alub+Vicente+Pires+II!5e0!3m2!1spt-BR!2sbr!4v1564900228031!5m2!1spt-BR!2sbr" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                {{-- </div>
            </div> --}}
    </section>

    <footer id="footer">
        <div class="container py-5">
           <div class="row">
              <div class="col-sm-12 col-md-3">
                 <h3>Our location</h3>
                 <p>2900 Lapeer Rd, Port Hurons, MI 49070</p>
                 <ul class="social-link flex">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
                 </ul>
                 <!--/.social-link-->
              </div>

              <div class="col-sm-12 col-md-3">
                 <h3>Working Hours</h3>
                 <p>Monday - Friday 8AM - 6PM</p>
                 <p>Saturday - Sunday 9AM - 5PM</p>
              </div>

              <div class="col-sm-12 col-md-3">
                 <h3>Office Phone</h3>
                 <p><a href="#">+1 (800) 478-42-51</a></p>
                 <p><a href="#">+1 (800) 474-23-82</a></p>
              </div>

              <div class="col-sm-12 col-md-3">
                 <h3>Email</h3>
                 <p><a href="#">info@companyname.com</a></p>
                 <p><a href="#">sale@companyname.com</a></p>
              </div>
           </div>
        </div>

        <div class="copyright">
           <p>Copyright &copy; Todos os direitos reservados.</p>
        </div>
        <!--/.copyright-->

     </footer>
</x-layout_site_home>