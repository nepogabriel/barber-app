<x-layout title="Rodapé">
    @isset($message_success)
        <div class="alert alert-success">
            {{ $message_success }}
        </div>
    @endisset

    <section id="modules">
        {{-- 
            Adicionar google maps
            Logo footer
            Nome da loja
            Redes sociais
            Números de telefone
            Endereço escrito da loja
        --}}

        <form action="" method="post">
            @csrf
        
            {{-- @if($update)
            @method('PUT')
            @endif --}}
        
            <div class="mb-3">
                <label for="store-address" class="form-label">Endereço da loja:</label>
                <input type="text"
                        class="form-control"
                        id="store-address"
                        name="store_address"
                        @isset($data->store_address)
                            value="{{ $data->store_address }}"
                        @endisset/>
            </div>
        
            <a class="btn btn-danger" href="{{ route('admin.modules.index') }}">Cancelar</a>
            <button type="submit" class="btn btn-dark">Salvar</button>
        </form>
    </section>
</x-layout>