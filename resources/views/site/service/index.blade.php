<x-layout_site title="Escolha o serviço">
    <form action="{{ route('site.service.store') }}" method="post">
        @csrf

        <ul class="list-group">
            @foreach ($services as $service)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <input class="form-check-input me-1" type="radio" name="service_id" value="{{ $service->id }}" id="firstRadio"
                            @if ($service->id == $order_service_id)
                                checked
                            @endif
                        />
                        <label class="form-check-label" for="firstRadio">{{ $service->name }}</label>
                    </div>

                    <span class="d-flex btn btn-dark btn-sm">
                        {{ $service->price }}
                    </span>
                </li>
            @endforeach
        </ul>

        <div class="mt-3">
            <button type="submit" class="btn btn-dark">Continuar</button>
        </div>
    </form>
</x-layout_site>