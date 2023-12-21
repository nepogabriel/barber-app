<x-layout title="Serviços">
    <a href="{{ route('admin.service.create') }}" class="btn btn-dark mb-2">Cadastrar Serviço</a>

    @isset($message_success)
        <div class="alert alert-success">
            {{ $message_success }}
        </div>
    @endisset

    <ul class="list-group">
        @foreach ($services as $service)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $service->name }}

                <span class="d-flex">
                    <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-dark btn-sm">
                        E
                    </a>

                    <form action="{{ route('admin.service.destroy', $service->id) }}" method="post" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">X</button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>