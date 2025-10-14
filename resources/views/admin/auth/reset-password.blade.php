@include('components.header') {{-- Se você usa um header padrão --}}

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Cadastrar Nova Senha</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.password.update') }}">
                        @csrf

                        {{-- Este campo é crucial, ele envia o token de validação para o controller --}}
                        <input type="hidden" name="token" value="{{ $token }}">

                        {{-- Campo de E-mail --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Endereço de E-mail</label>
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ $email ?? old('email') }}" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   required 
                                   autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Campo de Nova Senha --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Nova Senha</label>
                            <input id="password" 
                                   type="password" 
                                   name="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   required 
                                   autocomplete="new-password"
                                   autofocus>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Campo de Confirmação de Senha --}}
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirmar Nova Senha</label>
                            <input id="password-confirm" 
                                   type="password" 
                                   name="password_confirmation" 
                                   class="form-control" 
                                   required 
                                   autocomplete="new-password">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Redefinir Senha
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.footer') {{-- Se você usa um footer padrão --}}