<x-layout title="Cadastrar Serviço '{{ $service->name }}'">
    <x-admin.service.form
        :action="route('admin.service.update', $service->id)"
        :cancel="route('admin.service.index')"
        :service="$service"
        :update="true"
    />
</x-layout>