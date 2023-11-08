<x-layout title="Profissionais">
    <a href="{{ route('professional.create') }}" class="btn btn-dark mb-2">Cadastrar Profissional</a>

    @isset($message_success)
        <div class="alert alert-success">
            {{ $message_success }}
        </div>
    @endisset

    <ul class="list-group">
        @foreach ($professionals as $professional)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $professional->name }}

                <span class="d-flex">
                    <a href="{{ route('professional.edit', $professional->id) }}" class="btn btn-primary btn-sm">
                        E
                    </a>

                    <form action="{{ route('professional.destroy', $professional->id) }}" method="post" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">X</button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>