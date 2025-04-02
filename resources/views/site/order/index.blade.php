<x-layout_site title="Resumo">
    <form action="{{ route('site.order.store') }}" method="post">
        @csrf
        
        <div class="row g-4 py-3">
            <div class="col-lg-7">
                <div class="card shadow-sm mb-2">
                    <div class="card-body p-4">
                        <h3 class="card-title fw-bold text-muted mb-4 d-flex justify-content-center">{{ $summary['title'] }}</h3>
                        
                        <hr/>
                        
                        @foreach ($summary['orders'] as $order)
                        <div class="row my-4">
                            <div class="col-md-6 my-1">
                                <h5 class="mb-2">{{ $order['service'] }}</h5>

                                <p class="mb-0">
                                    <i class="fa fa-money" aria-hidden="true"></i>&nbsp;
                                    R$&nbsp;{{ $order['price'] }}
                                </p>

                                <p class="mb-0">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                    {{ $order['date'] }}
                                </p>

                                <p class="mb-0">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                                    {{ $order['time'] }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="card-title fw-bold text-muted mb-4 d-flex justify-content-center">Detalhes</h3>

                        <hr/>
                        
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-2">Profissional</h5>
                                <p class="mb-0">
                                    <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                                    {{ $summary['professional'] }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-2">Cliente</h5>
                                <p class="mb-0">
                                    <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                                    {{ $summary['client']['name'] }}
                                </p>
                                <p class="mb-0">
                                    <i class="fa fa-volume-control-phone" aria-hidden="true"></i>&nbsp;
                                    {{ $summary['client']['telephone'] }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Subtotal</span>
                                <span>R$ {{ $summary['subtotal'] }}</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                                <h4 class="fw-bold text-success mb-0">Total</h4>
                                <h4 class="fw-bold text-success mb-0">R$ {{ $summary['total'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-3 d-flex justify-content-between">
            <a class="btn btn-outline-dark border-2" href="{{ route('site.client.index') }}">Voltar</a>
            <button type="submit" class="btn btn-layout border-2 border-dark">Confirmar</button>
        </div>
    </form>

<script>
window.addEventListener("pageshow", function (event) {
  if (event.persisted) {
    window.location.reload();
  }
});
</script>
</x-layout_site>