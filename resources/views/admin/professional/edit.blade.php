<x-layout title="Editar Profissional '{{ $professional->name }}'">
    <x-admin.professional.form
        :action="route('admin.professional.update', $professional->id)"
        :cancel="route('admin.professional.index')"
        :professional="$professional" 
        :update="true"
    />
</x-layout>