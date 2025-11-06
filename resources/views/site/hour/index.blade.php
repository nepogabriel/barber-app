<x-layout_site title="Escolha o horário">
    @isset($message_alert_user)
        <div class="alert alert-danger">
            {{ $message_alert_user }}
        </div>
    @endisset

    {{-- Calendar Element  --}}
    {{-- https://gramthanos.github.io/jsCalendar/ --}}
    <div class="material-theme custom-calendar calendar-hour d-flex justify-content-center mb-3"></div>

    <form action="{{ route('site.hour.store') }}" method="post">
        @csrf

        <div>
            <div class="row" id="list_hours"></div>
        </div>

        <div class="mt-3">
            <a class="btn btn-outline-dark border-2" href="{{ route('site.professional.index') }}">Voltar</a>
            <button type="submit" class="btn btn-layout border-2 border-dark">Continuar</button>
        </div>
    </form>
</x-layout_site>