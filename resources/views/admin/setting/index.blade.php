<x-layout title="Configuração">
    <form action="" method="post">
        @csrf
    
        {{-- @if($update)
        @method('PUT')
        @endif --}}
    
        <div class="mb-3">
            <label for="template-client" class="form-label">Tema cliente:</label>
            <select class="form-select" name="template_client" id="template-client">
                @foreach ($template_clients as $template)
                <option value="{{ $template }}">{{ $template }}</option>
                @endforeach
            </select>
        </div>
    
        <a class="btn btn-danger" href="#">Cancelar</a>
        <button type="submit" class="btn btn-dark">Salvar</button>
    </form>
</x-layout>