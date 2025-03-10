<x-layout_site title="Escolha o horário">
    @isset($message_alert_user)
        <div class="alert alert-danger">
            {{ $message_alert_user }}
        </div>
    @endisset

    {{-- Calendar Element  --}}
    {{-- <div class="auto-jsCalendar material-theme custom-calendar calendar-hour"></div> --}}
    <div class="material-theme custom-calendar calendar-hour d-flex justify-content-center mb-3"></div>

    <form action="{{ route('site.hour.store') }}" method="post">
        @csrf

        <ul id="list_hours" class="list-group">
            {{-- @foreach ($hours as $hour)
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="radio" name="hour_id" value="{{ $hour->id }}" id="firstRadio"
                        @if ($hour->id == $order_hour_id)
                            checked
                        @endif
                    />
                    <label class="form-check-label" for="firstRadio">{{ $hour->date }} - {{ $hour->time }}</label>
                </li>
            @endforeach --}}
        </ul>

        <div class="mt-3">
            <a class="btn btn-outline-dark border-2" href="{{ route('site.professional.index') }}">Voltar</a>
            <button type="submit" class="btn btn-layout border-2 border-dark">Continuar</button>
        </div>
    </form>
</x-layout_site>