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
                        <input type="email" name="email" class="form-control field-signin" placeholder="Email">
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control field-signin" placeholder="Senha">
                    </div>
                    
                    @isset($alert_user)
                    <span class="text-danger">{{ $alert_user }}</span>
                    @endisset

                    <button type="submit" class="btn btn-signin">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('components.footer')