<x-layout title="Cadastrar Serviço '{{ $service->name }}'">
    <x-admin.service.form
        :action="route('admin.service.update', $service->id)"
        :service="$service"
        :update="true"
    />
</x-layout>