<x-layout title="Cadastrar Serviço">
    <x-admin.service.form 
        :action="route('admin.service.store')"
        :update="false"
        :name="old('name')"
        :price="old('price')"
        :description="old('description')"
    />
</x-layout>