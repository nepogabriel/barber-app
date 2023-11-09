<x-layout title="Editar Profissional '{{ $professional->name }}'">
    <x-professional.form :action="route('professional.update', $professional->id)" :professional="$professional" :update="true"/>
</x-layout>