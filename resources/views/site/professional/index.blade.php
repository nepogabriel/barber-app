<x-layout_site title="Escolha o profissonal">
    <form action="{{ route('site.professional.store') }}" method="post">
        @csrf

        <ul class="list-group">
            @foreach ($professionals as $professional)
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="radio" name="professional_id" value="{{ $professional->id }}" id="firstRadio"
                        @if ($professional->id == $order_professional_id)
                            checked
                        @endif
                    />
                    <label class="form-check-label" for="firstRadio">{{ $professional->name }}</label>
                </li>
            @endforeach
        </ul>

        <div class="mt-3">
            <a class="btn btn-danger" href="{{ route('site.service.index') }}">Voltar</a>
            <button type="submit" class="btn btn-dark">Continuar</button>
        </div>
    </form>
</x-layout_site>