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
                @isset($service->name)
                    value="{{ $service->name }}"
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
                @isset($service->price)
                    value="{{ $service->price }}"
                @endisset
                @isset($price)
                    value="{{ $price }}"
                @endisset/>
    </div>
    
    <div class="mb-3">
        <label for="position" class="form-label">Descrição:</label>
        <textarea id="description" name="description" class="form-control" rows="4" cols="50">@isset($service->description){{ $service->description }}@endisset @isset($description){{ $description }}@endisset
        </textarea>
    </div>

    <a class="btn btn-danger" href="{{ $cancel }}">Cancelar</a>
    <button type="submit" class="btn btn-dark">Adicionar</button>
</form>