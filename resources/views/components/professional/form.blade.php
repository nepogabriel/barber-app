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
        <label for="telephone" class="form-label">Telefone:</label>
        <input type="text"
                id="telephone"
                name="telephone"
                class="form-control" 
                @isset($professional->telephone)
                    value="{{ $professional->telephone }}"
                @endisset
                
                @isset($telephone)
                    value="{{ $telephone }}"
                @endisset/>
    </div>
    
    <div class="mb-3">
        <label for="position" class="form-label">Cargo:</label>
        <select id="position" name="position" class="form-control">
            <option value="barbeiro">Barbeiro</option>
        </select>
    </div>

    <a class="btn btn-danger" href="{{ $cancel }}">Cancelar</a>
    <button type="submit" class="btn btn-dark">Adicionar</button>
</form>