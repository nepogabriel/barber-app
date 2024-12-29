<x-layout title="Rodapé">
    @isset($message_success)
        <div class="alert alert-success">
            {{ $message_success }}
        </div>
    @endisset

    <section id="modules">

        <form action="{{ route('admin.settings.modules.footer.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="footer-status" class="form-label">Status:</label>
                <select id="footer-status" name="status" class="form-control">
                    <option value="1" @if(isset($data->status) && $data->status == '1') selected @endisset>Habilitado</option>
                    <option value="0" @if(isset($data->status) && $data->status == '0') selected @endisset>Desabilitado</option>
                </select>
            </div>
        
            <div class="mb-3">
                <label for="store-address" class="form-label">Endereço da loja:</label>
                <input type="text"
                        class="form-control"
                        id="footer-store-address"
                        name="store_address"
                        @isset($data->store_address)
                            value="{{ $data->store_address }}"
                        @endisset/>
            </div>
        
            <a class="btn btn-danger" href="{{ route('admin.settings.modules.index') }}">Cancelar</a>
            <button type="submit" class="btn btn-dark">Salvar</button>
        </form>
    </section>
</x-layout>