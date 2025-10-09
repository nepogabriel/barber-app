@include('components.header')

<div class="page-wrapper">
    <div class="login-container">
        <div class="row g-0 login-container-border">
            <div class="col-md-5 background-message">
                <h2 class="mb-4 fw-bold">Olá!</h2>
                <p class="mb-4">É um prazer te ver por aqui.</p>
            </div>

            <div class="col-md-7 login-form">
                <h2 class="mb-4 fw-bold text-center">Realize o login</h2>
                
                <p class="text-center text-muted mb-4">Acesse nossa plataforma para mais detalhes.</p>

                <form method="post">
                    @csrf

                    <div class="mb-3">
                        <input
                            type="email"
                            name="email"
                            placeholder="Email"
                            value="{{ old('email') }}"
                            class="form-control field-signin @error('email') is-invalid @enderror"
                            />

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input
                            type="password"
                            name="password"
                            placeholder="Senha"
                            class="form-control field-signin @error('password') is-invalid @enderror"
                            />

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (session('alert_user'))
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;{{ session('alert_user') }}
                    </div>
                    @endif 

                    <button type="submit" class="btn btn-signin">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('components.footer')