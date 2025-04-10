@include('components.header')

<style>
    html, body {
        height: 100%;
        background-color: #f0f2ff;
    }
    .page-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .login-container {
        background-color: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        max-width: 900px;
        width: 100%;
        margin: 0 auto; /* Ensure horizontal centering */
    }
    .login-form {
        padding: 40px;
    }
    .social-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
        margin: 0 5px;
        transition: all 0.3s;
    }
    .social-btn:hover {
        background-color: #f8f9fa;
        color: #333;
    }
    .form-control {
        background-color: #f5f5f5;
        border: none;
        padding: 15px;
        margin-bottom: 15px;
    }
    .btn-signin {
        background-color: #000000;
        color: white;
        border: none;
        padding: 10px 0;
        border-radius: 5px;
        width: 100%;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .btn-signin:hover,
    .btn-signin:active,
    :not(.btn-check)+.btn-signin:active {
        color: #FFFFFF;
        border: none;
        background-color: #000000;
        opacity: 0.8;
    }
    
    .btn-signup {
        border: 1px solid white;
        background-color: transparent;
        color: white;
        padding: 10px 30px;
        border-radius: 30px;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s;
    }
    .btn-signup:hover {
        background-color: white;
        color: #000000;
    }
    .purple-bg {
        background-color: #000000;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px;
        text-align: center;
        /* height: 100%; */
        border-radius: 100px 20px 20px 100px;
    }
    .forgot-password {
        color: #888;
        text-decoration: none;
        font-size: 14px;
        display: block;
        text-align: center;
        margin-bottom: 20px;
    }
    .forgot-password:hover {
        color: #000000;
    }
    @media (max-width: 767.98px) {
        .purple-bg {
            border-radius: 0 0 20px 20px;
            padding: 30px;
        }
    }
</style>

<div class="page-wrapper">
        <!-- Removed the container class that was causing centering issues -->
        <div class="login-container">
            <div class="row g-0"> <!-- Added g-0 to remove gutters -->
                <!-- Left side - Login Form -->
                <div class="col-md-7 login-form">
                    <h2 class="mb-4 fw-bold text-center">Realize o login</h2>
                    
                    <!-- Social Login Buttons -->
                    <!-- <div class="d-flex justify-content-center mb-3">
                        <a href="#" class="social-btn">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-btn">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-btn">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="social-btn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div> -->
                    
                    <p class="text-center text-muted mb-4">Acesse nossa plataforma para mais detalhes.</p>
                    
                    <!-- Login Form -->
                    <form method="post">
                        @csrf

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Senha">
                        </div>
                        
                        @isset($alert_user)
                        <span class="text-danger">{{ $alert_user }}</span>
                        @endisset

                        <button type="submit" class="btn btn-signin">Entrar</button>
                        <!-- <a href="#" class="forgot-password">Esqueceu a senha?</a> -->
                    </form>
                </div>
                
                <!-- Right side - Purple Section -->
                <div class="col-md-5 purple-bg">
                    <h2 class="mb-4 fw-bold">Olá!</h2>
                    <p class="mb-4"> É prazer te ver por aqui.</p>
                    <!-- <p class="mb-4">Register with your personal details to use all of site features</p> -->
                    <!-- <a href="#" class="btn btn-signup">SIGN UP</a> -->
                </div>
            </div>
        </div>
    </div>

@include('components.footer')