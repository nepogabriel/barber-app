<x-layout title="Profissionais">
    <a href="{{ route('professional.create') }}" class="btn btn-dark mb-2">Adicionar Série</a>

    <ul class="list-group">
        @foreach ($professionals as $professional)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $professional->name }}

                <form action="{{ route('professional.destroy', $professional->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">X</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>