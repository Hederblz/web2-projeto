<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-commerce | Início</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark" style="font-family: 'DM Sans', sans-serif;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-4" href="{{ url('/') }}" style="font-family: 'Syne', sans-serif;">
                E-commerce
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ url('/categorias') }}">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ url('/produtos') }}">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ url('/users') }}">Usuários</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="{{ url('/login') }}" class="text-secondary text-decoration-none me-4">Entrar</a>
                    <a href="{{ url('/register') }}" class="btn btn-secondary shadow-sm rounded-3 px-3">Criar Conta</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-white shadow-sm overflow-hidden position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 py-5 py-lg-5 pe-lg-5 z-1">
                    <h1 class="display-4 fw-bolder text-dark mb-4" style="font-family: 'Syne', sans-serif;">
                        Gerencie sua loja com <br>
                        <span class="text-primary">facilidade e rapidez</span>
                    </h1>
                    <p class="lead text-secondary mb-5">
                        O sistema completo para o seu E-commerce. Controle suas categorias, gerencie o estoque dos seus produtos e administre seus usuários em um só lugar de forma simples e intuitiva.
                    </p>
                    <div class="d-grid gap-3 d-md-flex justify-content-md-start">
                        <a href="{{ url('/produtos') }}" class="btn btn-primary btn-lg px-4 py-3 shadow-sm rounded-3 fw-medium">
                            Acessar Produtos
                        </a>
                        <a href="{{ url('/categorias') }}" class="btn text-primary fw-medium btn-lg px-4 py-3 rounded-3" style="background-color: #e7f1ff; border: 1px solid #cfe2ff;">
                            Ver Categorias
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="position-absolute end-0 top-0 h-100 d-none d-lg-block" style="width: 50%;">
            <img class="w-100 h-100" style="object-fit: cover;" src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="E-commerce">
        </div>
        
        <div class="d-block d-lg-none mt-4">
             <img class="w-100" style="height: 300px; object-fit: cover;" src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="E-commerce">
        </div>
    </div>

    <footer class="bg-white border-top mt-5 py-5 text-center text-secondary small">
        <div class="container">
            <p class="mb-1">&copy; {{ date('Y') }} E-commerce. Todos os direitos reservados.</p>
            <p class="mb-0">Sistema desenvolvido em Laravel.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>