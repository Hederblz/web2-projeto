<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Web 2</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background: linear-gradient(90deg, #1e293b 0%, #0f172a 100%);
        }
        .navbar-custom .nav-link {
            color: #cbd5e1;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }
        .navbar-custom .nav-link:hover {
            color: #ffffff;
        }
        .navbar-custom .nav-link.active {
            color: #60a5fa !important;
            background-color: rgba(255, 255, 255, 0.1);
            font-weight: 600;
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm py-3 mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 d-flex align-items-center tracking-wide" href="/">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-2 text-primary" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                </svg>
                E-commerce
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
                    <li class="nav-item">
                        <a class="nav-link px-3 rounded-3 {{ request()->routeIs('categorias.*') ? 'active' : '' }}" href="{{ route('categorias.index') }}">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 rounded-3 {{ request()->routeIs('produtos.*') ? 'active' : '' }}" href="{{ route('produtos.index') }}">Produtos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-4 mb-4 d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="me-3 text-success" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <div>
                    <strong class="fw-bold">Sucesso!</strong> {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
        
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>