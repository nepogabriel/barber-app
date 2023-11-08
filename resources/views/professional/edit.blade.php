<x-layout title="Editar Profissional '{{ $professional->name }}'">
    <x-professional.form :action="route('professional.store')" :professional="$professional"/>
</x-layout>