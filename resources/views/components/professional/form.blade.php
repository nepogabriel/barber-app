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
                @isset($professional->name) value="{{ $professional->name }}" @endisset/>
    </div>

    <div class="mb-3">
        <label for="telephone" class="form-label">Telefone:</label>
        <input type="text"
                id="telephone"
                name="telephone"
                class="form-control" 
                @isset($professional->telephone) value="{{ $professional->telephone }}" @endisset/>
    </div>
    
    <div class="mb-3">
        <label for="position" class="form-label">Cargo:</label>
        <select id="position" name="position" class="form-control">
            <option value="barbeiro">Barbeiro</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>