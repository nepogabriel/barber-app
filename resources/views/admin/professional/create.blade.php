<x-layout title="Cadastrar Profissional">
    <x-admin.professional.form 
        :action="route('admin.professional.store')"
        :cancel="route('admin.professional.index')"
        :update="false"
        :name="old('name')"
        :telephone="old('telephone')"
        :email="old('email')"
        :password="old('password')"
    />
</x-layout>