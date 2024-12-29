<x-layout title="Módulos">
    @isset($message_success)
        <div class="alert alert-success">
            {{ $message_success }}
        </div>
    @endisset

    <section id="modules">
        <ul class="list-group">
        @foreach ($modules as $path => $name)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $name }}

                <span class="d-flex">
                    <a href="{{ route('admin.settings.modules.' . $path . '.edit', $path) }}" class="btn btn-dark btn-sm">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                </span>
            </li>
        @endforeach
    </section>
</x-layout>