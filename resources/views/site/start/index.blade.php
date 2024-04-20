<x-layout_site title="Início">
    @isset($message_order_success)
        <div class="alert alert-success">
            {{ $message_order_success }}
        </div>
    @endisset

    <div class="mt-3 d-flex justify-content-center">
        <a class="btn btn-bege border-2 border-dark" href="{{ route('site.service.index') }}">Agendar Serviço</a>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        <a class="btn btn-outline-dark border-2" href="{{ route('site.start.check') }}">Consultar Agendamento</a>
    </div>
</x-layout_site>