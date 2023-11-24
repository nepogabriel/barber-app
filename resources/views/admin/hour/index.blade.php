<x-layout title="Horários">
    <a href="{{ route('admin.hour.create') }}" class="btn btn-dark mb-2">Cadastrar Horário</a>

    @isset($message_success)
        <div class="alert alert-success">
            {{ $message_success }}
        </div>
    @endisset

    
    @foreach ($professionals as $professional)
        <div class="my-4">
            <h3 class="mb-2">{{ $professional->name }}</h3>

            {{-- <ul class="list-group">
                @foreach ($hours as $hour)
                    @if ($hour->professional_id == $professional->id)
                        <li class="list-group-item">{{ $hour->date }} | {{ $hour->time }}</li>
                    @endif
                @endforeach
            </ul> --}}

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Horário</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($hours as $hour)
                        @if ($hour->professional_id == $professional->id)
                            <tr>
                                <td>{{ $hour->date }}</td>
                                <td>{{ $hour->time }}</td>
                                <td class="d-flex justify-content-end">
                                    <span class="d-flex">
                                        <a href="#" class="btn btn-dark btn-sm">
                                            E
                                        </a>
                    
                                        <form action="{{ route('admin.hour.destroy', $hour->id) }}" method="post" class="ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">X</button>
                                        </form>
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