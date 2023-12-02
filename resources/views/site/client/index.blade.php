<x-layout_site title="Informe seus dados">
    <form action="{{ route('site.client.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text"
                id="name_client"
                name="name_client"
                class="form-control"
                @isset($name_client)
                    value="{{ $name_client }}"
                @endisset
            />
        </div>
    
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
            <a class="btn btn-danger" href="{{ route('site.hour.index') }}">Voltar</a>
            <button type="submit" class="btn btn-dark">Continuar</button>
        </div>
    </form>
</x-layout_site>