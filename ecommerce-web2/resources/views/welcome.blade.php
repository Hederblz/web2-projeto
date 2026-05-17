<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-commerce | Início</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800 font-sans selection:bg-blue-500 selection:text-white">

    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="font-bold text-2xl tracking-wider text-blue-400 hover:text-blue-300 transition">E-commerce</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ url('/categorias') }}" class="text-gray-300 hover:text-white font-medium transition">Categorias</a>
                    <a href="{{ url('/produtos') }}" class="text-gray-300 hover:text-white font-medium transition">Produtos</a>
                    <a href="{{ url('/users') }}" class="text-gray-300 hover:text-white font-medium transition">Usuários</a>
                    
                    <div class="border-l border-gray-600 pl-4 ml-2 flex items-center space-x-4">
                        <a href="{{ url('/login') }}" class="text-gray-400 hover:text-white text-sm transition">Entrar</a>
                        <a href="{{ url('/register') }}" class="bg-gray-700 hover:bg-gray-600 text-white text-sm px-4 py-2 rounded-lg transition shadow">Criar Conta</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="relative bg-white overflow-hidden shadow-sm">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-16 lg:pt-24">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Gerencie sua loja com</span>
                            <span class="block text-blue-600 xl:inline">facilidade e rapidez</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-600 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            O sistema completo para o seu E-commerce. Controle suas categorias, gerencie o estoque dos seus produtos e administre seus usuários em um só lugar de forma simples e intuitiva.
                        </p>
                        
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ url('/produtos') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 transition">
                                    Acessar Produtos
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="{{ url('/categorias') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-blue-700 bg-blue-100 hover:bg-blue-200 md:py-4 md:text-lg md:px-10 transition">
                                    Ver Categorias
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Imagem de E-commerce">
        </div>
    </div>

    <footer class="bg-white border-t border-gray-200 mt-12 py-8 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} E-commerce. Todos os direitos reservados.</p>
        <p class="mt-2">Sistema desenvolvido em Laravel.</p>
    </footer>

</body>
</html>