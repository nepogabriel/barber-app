<x-layout title="Cadastrar Serviço">
    <x-admin.service.form 
        :action="route('admin.service.store')"
        :update="false"
        {{-- :name="old('name')"
        :telephone="old('telephone')" --}}
    />
</x-layout>