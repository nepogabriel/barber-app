<x-layout title="Profissionais">
    <a href="{{ route('admin.professional.create') }}" class="btn btn-dark mb-2">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Cadastrar Profissional
    </a>

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
                    <a href="{{ route('admin.professional.edit', $professional->id) }}" class="btn btn-dark btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>

                    <form action="{{ route('admin.professional.destroy', $professional->id) }}" method="post" class="ms-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>