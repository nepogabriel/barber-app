<x-layout_site title="Consultar Horário">
    <form action="{{ route('site.start.show') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Telefone:</label>
            <input type="text"
                id="telephone_client"
                name="telephone_client"
                class="form-control"
                @isset($telephone_client)
                    value="{{ $telephone_client }}"
                @endisset
            />
        </div>

        <div class="mt-3">
            <a class="btn btn-outline-dark border-2" href="{{ route('site.start.index') }}">Voltar</a>
            <button type="submit" class="btn btn-bege border-2 border-dark">Consultar</button>
        </div>
    </form>
</x-layout_site>