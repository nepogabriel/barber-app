<x-layout_site title="Resumo">
    <form action="{{ route('site.order.store') }}" method="post">
        @csrf

        <table class="table table-sm">
            <tbody>
              <tr>
                <td class="fw-bold">Data:</td>
                <td>{{ $order['hour'][0]->date }}</td>
                <input type="hidden" name="hour_id" value="{{ $order['hour'][0]->id }}"/>
              </tr>

              <tr>
                <td class="fw-bold">Horário:</td>
                <td>{{ $order['hour'][0]->time }}</td>
              </tr>

              <tr>
                <td class="fw-bold">Profissional:</td>
                <td>{{ $order['professional'][0]->name }}</td>
                <input type="hidden" name="professional_id" value="{{ $order['professional'][0]->id }}"/>
              </tr>

              <tr>
                <td class="fw-bold">Serviço:</td>
                <td>{{ $order['service'][0]->name }}</td>
                <input type="hidden" name="service_id" value="{{ $order['service'][0]->id }}"/>
              </tr>

              <tr>
                <td class="fw-bold">Valor:</td>
                <td>R$&nbsp;{{ $order['service'][0]->price }}</td>
              </tr>
              
              <tr>
                <td class="fw-bold">Cliente:</td>
                <td>{{ $order_session['name_client'] }}</td>
                <input type="hidden" name="name_client" value="{{ $order_session['name_client'] }}"/>
              </tr>

              <tr>
                <td class="fw-bold">Tel. Cliente:</td>
                <td>{{ $order_session['telephone_client'] }}</td>
                <input type="hidden" name="telephone_client" value="{{ $order_session['telephone_client'] }}"/>
              </tr>
            </tbody>
          </table>

        <div class="mt-3">
            <a class="btn btn-outline-dark border-2" href="{{ route('site.client.index') }}">Voltar</a>
            <button type="submit" class="btn btn-layout border-2 border-dark">Confirmar</button>
        </div>
    </form>

<script>
window.addEventListener("pageshow", function (event) {
  if (event.persisted) {
    window.location.reload();
  }
});
</script>
</x-layout_site>