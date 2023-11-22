<x-layout title="Cadastrar Profissional">
    <x-professional.form 
        :action="route('professional.store')"
        :update="false"
        :name="old('name')"
        :telephone="old('telephone')"
    />

    {{-- <form action="{{ route('professional.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Telefone:</label>
            <input type="text" id="telephone" name="telephone" class="form-control">
        </div>
        
        <div class="mb-3">
            <label for="position" class="form-label">Cargo:</label>
            <select id="position" name="position" class="form-control">
                <option value="barbeiro">Barbeiro</option>
            </select>
        </div>

        <button type="submit" class="btn btn-dark">Adicionar</button>
    </form> --}}
</x-layout>