<x-layout title="Cadastrar Horário">
    <form action="{{ route('admin.hour.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">Dia:</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Horário:</label>
            <input type="time" name="time" id="time" class="form-control">
        </div>

        <div class="mb-3">
            <label for="professional_hour" class="form-label">Profissional:</label>
            <select name="professional_id" id="professional_hour" class="form-control">
                @foreach ($professionals as $professional)
                    <option value="{{ $professional->id }}">{{ $professional->name }}</option>
                @endforeach
            </select>
        </div>

        <a class="btn btn-danger" href="{{ route('admin.hour.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-dark">Adicionar</button>
    </form>
</x-layout>