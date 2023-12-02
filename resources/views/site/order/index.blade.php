<x-layout_site title="Resumo">
    <form action="{{ route('site.client.store') }}" method="post">
        @csrf

        <table class="table table-sm">
            <tbody>
              <tr>
                <td>Data:</td>
                <td>{{ $order['hour'][0]->date }}</td>
              </tr>
              <tr>
                <td>Horário:</td>
                <td>{{ $order['hour'][0]->time }}</td>
              </tr>

              <tr>
                <td>Profissional:</td>
                <td>{{ $order['professional'][0]->name }}</td>
              </tr>

              <tr>
                <td>Serviço:</td>
                <td>{{ $order['service'][0]->name }}</td>
              </tr>

              <tr>
                <td>Valor:</td>
                <td>R$&nbsp;{{ $order['service'][0]->price }}</td>
              </tr>
              
              <tr>
                <td>Cliente:</td>
                <td>{{ $order_session['name_client'] }}</td>
              </tr>

              <tr>
                <td>Tel. Cliente:</td>
                <td>{{ $order_session['telephone_client'] }}</td>
              </tr>
            </tbody>
          </table>

        <div class="mt-3">
            <a class="btn btn-danger" href="{{ route('site.client.index') }}">Voltar</a>
            <button type="submit" class="btn btn-dark">Confirmar</button>
        </div>
    </form>
</x-layout_site>