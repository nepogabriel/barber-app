<x-layout title="Editar Horário">
    <form action="{{ route('admin.hour.update', $hour['0']->id) }}" method="post">
        @csrf

        @method('PUT')

        <div class="mb-3">
            <label for="date" class="form-label">Data:</label>
            <input 
                type="date"
                name="date"
                id="date"
                class="form-control"
                @isset($hour['0']->date) value="{{ $hour['0']->date }}" @endisset
            />
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Horário:</label>
            <input
                type="time"
                name="time"
                id="time"
                class="form-control"
                @isset($hour['0']->time) value="{{ $hour['0']->time }}" @endisset
            />
        </div>

        <div class="mb-3">
            <label for="professional_hour" class="form-label">Profissional:</label>
            <select name="professional_id" id="professional_hour" class="form-control">
                <option value="{{ $hour['0']->professional_id }}">{{ $hour['0']->name }}</option>

                {{-- @foreach ($professionals as $professional)
                    <option value="{{ $professional->id }}"
                        @if ($professional == $hour['0']->professional_id) 
                            selected
                        @endif
                    >
                        {{ $professional->name }}
                    </option>
                @endforeach --}}
            </select>
        </div>

        <a class="btn btn-danger" href="{{ route('admin.hour.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-dark">Adicionar</button>
    </form>
</x-layout>