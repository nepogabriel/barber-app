<form action="{{ $action }}" method="post">
    @csrf

    @if($update)
    @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text"
                id="name"
                name="name"
                class="form-control"
                @isset($professional->name)
                    value="{{ $professional->name }}"
                @endisset
                @isset($name)
                    value="{{ $name }}"
                @endisset/>
    </div>

    <div class="mb-3">
        <label for="nome" class="form-label">Preço:</label>
        <input type="text"
                id="price"
                name="price"
                class="form-control"
                @isset($professional->name)
                    value="{{ $professional->name }}"
                @endisset
                @isset($name)
                    value="{{ $name }}"
                @endisset/>
    </div>
    
    <div class="mb-3">
        <label for="position" class="form-label">Descrição:</label>
        <textarea id="description" name="description" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>