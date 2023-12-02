<x-layout title="Agenda">
    <a href="{{ route('admin.hour.create') }}" class="btn btn-dark mb-2">Cadastrar Horário</a>

    @isset($message_success)
        <div class="alert alert-success">
            {{ $message_success }}
        </div>
    @endisset

    
    @foreach ($professionals as $professional)
        <div class="my-4">
            <h3 class="mb-2">{{ $professional->name }}</h3>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Horário</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        @if ($appointment->professional_id == $professional->id)
                            <tr>
                                <td>{{ $appointment->date }}</td>
                                <td>{{ $appointment->time }}</td>
                                {{-- <td class="">
                                    @if ($appointment->checked)
                                        Sim        
                                    @else
                                        Não
                                    @endif
                                </td> --}}
                                <td class="d-flex justify-content-end">
                                    <span class="d-flex">
                                        {{-- <a href="{{ route('admin.hour.edit', $appointment->id) }}" class="btn btn-dark btn-sm">
                                            E
                                        </a> --}}
                    
                                        {{-- <form action="{{ route('admin.hour.destroy', $appointment->id) }}" method="post" class="ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">X</button>
                                        </form> --}}

                                        <button class="btn btn-danger btn-sm">X</button>
                                    </span>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</x-layout>