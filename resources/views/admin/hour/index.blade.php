<x-layout title="Horários">
    <a href="{{ route('admin.hour.create') }}" class="btn btn-dark mb-2">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Cadastrar Horário
    </a>

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
                    <th scope="col">Marcado</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($hours as $hour)
                        @if ($hour->professional_id == $professional->id)
                            <tr>
                                <td>{{ $hour->date }}</td>
                                <td>{{ $hour->time }}</td>
                                <td class="">
                                    @if ($hour->checked)
                                        Sim        
                                    @else
                                        Não
                                    @endif
                                </td>
                                <td class="d-flex justify-content-end">
                                    <span class="d-flex">
                                        <a href="{{ route('admin.hour.edit', $hour->id) }}" class="btn btn-dark btn-sm">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                    
                                        <form action="{{ route('admin.hour.destroy', $hour->id) }}" method="post" class="ms-2">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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