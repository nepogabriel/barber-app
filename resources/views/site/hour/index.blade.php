<x-layout_site title="Escolha o horário">

    {{-- Calendar Element  --}}
    {{-- <div class="auto-jsCalendar material-theme custom-calendar calendar-hour"></div> --}}
    <div class="material-theme custom-calendar calendar-hour"></div>

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
            <a class="btn btn-outline-dark border-2" href="{{ route('site.professional.index') }}">Voltar</a>
            <button type="submit" class="btn btn-bege border-2 border-dark">Continuar</button>
        </div>
    </form>
</x-layout_site>