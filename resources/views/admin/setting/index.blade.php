<x-layout title="Configuração">
    @isset($message_success)
        <div class="alert alert-success">
            {{ $message_success }}
        </div>
    @endisset

    <form action="{{ route('admin.setting.store') }} " method="post">
        @csrf

        <input
            type="hidden"
            name="setting_id"
            @isset($settings[0]->id)
                value="{{ $settings[0]->id }}"
            @endisset />
    
        <div class="mb-3">
            <label for="template-client" class="form-label">Tema cliente:</label>
            <select class="form-select" name="template_client" id="template-client">
                @foreach ($template_clients as $template)
                <option value="{{ $template }}" @if(isset($settings[0]->template_client) && $settings[0]->template_client == $template) selected @endif>
                    {{ $template }}
                </option>
                @endforeach
            </select>
        </div>
    
        <a class="btn btn-danger" href="#">Cancelar</a>
        <button type="submit" class="btn btn-dark">Salvar</button>
    </form>
</x-layout>