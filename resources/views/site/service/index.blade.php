<x-layout_site title="Escolha o serviço">
    @isset($message_order_success)
        <div class="alert alert-success">
            {{ $message_order_success }}
        </div>
    @endisset

    <form action="{{ route('site.service.store') }}" method="post">
        @csrf

        <ul class="list-group">
            @foreach ($services as $service)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <input class="form-check-input me-1" type="checkbox" name="service_id[]" value="{{ $service->id }}"
                            @if (isset($order_service_id) && in_array($service->id, $order_service_id))
                                checked
                            @endif
                        />
                        <label class="form-check-label" for="firstRadio">{{ $service->name }}</label>
                    </div>

                    <span class="d-flex btn btn-sm btn-bege border border-dark">
                        R$&nbsp;{{ $service->price }}
                    </span>
                </li>
            @endforeach
        </ul>

        <div class="mt-3">
            <a class="btn btn-outline-dark border-2" href="{{ route('site.start.index') }}">Voltar</a>
            <button type="submit" class="btn btn-bege border border-dark">Continuar</button>
        </div>
    </form>
</x-layout_site>