<x-layout_site title="Consultar Horário">
    @isset($message_alert_user)
        <div class="alert alert-danger">
            {{ $message_alert_user }}
        </div>
    @endisset

    <form action="{{ route('site.start.show') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Telefone:</label>
            <input type="text"
                id="telephone_client"
                name="telephone_client"
                class="form-control"
                @isset($appointments[0]->telephone_client)
                    value="{{ $appointments[0]->telephone_client }}"
                @endisset
            />
        </div>

        @if(isset($appointments) && $appointments->isNotEmpty())
            @foreach ($appointments as $appointment)
                <div class="mb-3 border-bottom">
                    <p>Data: {{ $appointment->date }}</p>
                    <p>Hora: {{ $appointment->time }}</p>
                    <p>Profissional: {{ $appointment->name }}</p>
                </div>
            @endforeach
        @elseif(isset($appointments) && !isset($appointments[0]))
            <p class="text-danger">Agendamento não encontrado! Verifique o número de telefone.</p>
        @endif

        <div class="mt-3">
            <a class="btn btn-outline-dark border-2" href="{{ route('site.start.index') }}">Voltar</a>
            <button type="submit" class="btn btn-layout border-2 border-dark">Consultar</button>
        </div>
    </form>
</x-layout_site>