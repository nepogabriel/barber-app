<x-layout_site title="Escolha o horário">
    <form action="{{ route('site.hour.store') }}" method="post">
        @csrf

        <ul class="list-group">
            @foreach ($hours as $hour)
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="radio" name="hour_id" value="{{ $hour->id }}" id="firstRadio"
                        @if ($hour->id == $order_hour_id)
                            checked
                        @endif
                    />
                    <label class="form-check-label" for="firstRadio">{{ $hour->date }} - {{ $hour->time }}</label>
                </li>
            @endforeach
        </ul>

        <div class="mt-3">
            <a class="btn btn-danger" href="{{ route('site.professional.index') }}">Voltar</a>
            <button type="submit" class="btn btn-dark">Continuar</button>
        </div>
    </form>
</x-layout_site>