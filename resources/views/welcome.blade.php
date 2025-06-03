<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Prodify - Gerenciamento de Produtos</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800">
<div class="bg-white">
    <header class="container mx-auto absolute inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Prodify</span>
                    <img class="h-10 sm:h-14 w-auto" src="{{ asset('images/prodify.svg') }}" alt="logo">
                </a>
            </div>

            <div class="flex lg:flex-1 lg:justify-end">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm/6 font-semibold text-gray-900">Dashboard <span aria-hidden="true">&rarr;</span></a>
                    @else
                        <a href="{{ url('/login') }}" class="text-sm/6 font-semibold text-gray-900">Entrar <span aria-hidden="true">&rarr;</span></a>
                    @endauth
                @endif
            </div>
        </nav>
    </header>

    <div class="relative isolate px-6 pt-24 lg:px-8">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="mx-auto max-w-3xl py-32 sm:py-48 lg:py-56">
            <div class="text-center">
                <h1 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-7xl">
                    Gerencie seus produtos com eficiência
                </h1>
                <p class="mt-8 text-pretty text-md font-medium text-gray-500 sm:text-xl/8">
                    Gerencie seus produtos com praticidade e eficiência. Controle o estoque, organize categorias e centralize todas as informações em uma única plataforma.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Registra-se
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-42rem)]" aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </div>
</div>
</body>
</html>
