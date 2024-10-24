<x-layout title="Módulos">
    @isset($message_success)
        <div class="alert alert-success">
            {{ $message_success }}
        </div>
    @endisset

    {{ $modules }}
</x-layout>