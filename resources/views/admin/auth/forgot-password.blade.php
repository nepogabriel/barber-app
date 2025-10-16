@include('components.header') {{-- Se você usa um header padrão --}}

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Redefinir Senha</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Esqueceu sua senha? Sem problemas. Informe seu e-mail abaixo e enviaremos um link para você cadastrar uma nova.</p>

                    {{-- Exibe a mensagem de sucesso após o envio do e-mail --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.email') }}">
                        @csrf

                        {{-- Campo de E-mail --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Endereço de E-mail</label>
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   required 
                                   autocomplete="email" 
                                   autofocus>

                            {{-- Exibe o erro de validação (ex: e-mail inválido) ou o erro de usuário não encontrado --}}
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Enviar Link de Redefinição
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.footer') {{-- Se você usa um footer padrão --}}