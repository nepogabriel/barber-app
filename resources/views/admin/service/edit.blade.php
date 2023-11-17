<x-layout title="Cadastrar Serviço '{{ $service->name }}'">
    <x-admin.service.form
        {{-- Trocar essa action para update --}}
        :action="route('admin.service.store')"
        :service="$service"
        :update="true"
    />
</x-layout>