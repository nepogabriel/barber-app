<x-layout title="Cadastrar Horário">
    <form action="" method="post">
        @csrf

        <div class="mb-3">
            <label for="day" class="form-label">Dia:</label>
            <input type="date" name="day" id="day" class="form-control">
        </div>

        <div class="mb-3">
            <label for="hour" class="form-label">Horário:</label>
            <input type="time" name="hour" id="hour" class="form-control">
        </div>

        <div class="mb-3">
            <label for="professional_hour" class="form-label">Profissional:</label>
            <select name="professional_hour" id="professional_hour" class="form-control">
                {{-- <option value="">Paulo Henrique</option> --}}

                @foreach ($professionals as $professional)
                    <option value="{{ $professional->id }}">{{ $professional->name }}</option>
                @endforeach
            </select>
        </div>

        <a class="btn btn-danger" href="#">Cancelar</a>
        <button type="submit" class="btn btn-dark">Adicionar</button>
    </form>
</x-layout>