<x-layout title="Configuração">
    @isset($message_success)
        <div class="alert alert-success">
            {{ $message_success }}
        </div>
    @endisset

    <form action="{{ route('admin.settings.general.store') }} " method="post" enctype="multipart/form-data">
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

        <hr>

        <div class="mb-3">
            <label for="logo-header" class="form-label">Logo Menu:</label>
            <div class="col-sm-12">
                <img class="config-logo-header" src="{{ $logo_header }}" alt="Logo">
            </div>
            <input class="form-control" type="file" name="logo_header" id="logo-header">
        </div>

        <hr>

        <div class="mb-3">
            <label for="number-whatsapp" class="form-label">Número Whatsapp:</label>
            <input class="form-control" type="text" name="whatsapp" 
                @isset($settings[0]->whatsapp)
                    value="{{ $settings[0]->whatsapp }}"
                @endisset /> {{-- Adicionar validação para número de telefone--}}
        </div>
    
        <a class="btn btn-danger" href="#">Cancelar</a>
        <button type="submit" class="btn btn-dark">Salvar</button>
    </form>
</x-layout>