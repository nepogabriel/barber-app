<x-layout_site title="Resumo">
  @isset($message_order_success)
    <div class="alert alert-success">
        {{ $message_order_success }}
    </div>
  @endisset

  {{-- MONTAR PÁGINA DE SUCESSO --}}

  <div class="mt-3">
    <a class="btn btn-layout border-2 border-dark" href="{{ route('site.start.index') }}">Ir para home</a>
</div>
</x-layout_site>