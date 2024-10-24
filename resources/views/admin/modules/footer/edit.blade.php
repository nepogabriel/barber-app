<x-layout title="Módulos">
    @isset($message_success)
        <div class="alert alert-success">
            {{ $message_success }}
        </div>
    @endisset

    <section id="modules">
        {{ $footer}}
    </section>
</x-layout>