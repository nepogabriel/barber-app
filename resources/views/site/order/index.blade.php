<x-layout_site title="Resumo">
    <form action="{{ route('site.order.store') }}" method="post">
        @csrf

        <table class="table table-sm">
            <tbody>
              <tr>
                <td class="fw-bold">Data:</td>
                <td>{{ $order['hour'][0]->date }}</td>
                <input type="hidden" name="order_date" value="{{ $order['hour'][0]->date }}"/>
              </tr>
              <tr>
                <td class="fw-bold">Horário:</td>
                <td>{{ $order['hour'][0]->time }}</td>
              </tr>

              <tr>
                <td class="fw-bold">Profissional:</td>
                <td>{{ $order['professional'][0]->name }}</td>
              </tr>

              <tr>
                <td class="fw-bold">Serviço:</td>
                <td>{{ $order['service'][0]->name }}</td>
              </tr>

              <tr>
                <td class="fw-bold">Valor:</td>
                <td>R$&nbsp;{{ $order['service'][0]->price }}</td>
              </tr>
              
              <tr>
                <td class="fw-bold">Cliente:</td>
                <td>{{ $order_session['name_client'] }}</td>
              </tr>

              <tr>
                <td class="fw-bold">Tel. Cliente:</td>
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