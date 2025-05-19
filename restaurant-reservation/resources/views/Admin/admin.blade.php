<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - RestoReserve</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS principal -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- CSRF Token pour les requêtes AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @stack('styles')
</head>
<body>

    <!-- Barre latérale -->
    @include('admin.partials.sidebar')

    <!-- Contenu principal -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Modales partagées -->
    @include('admin.partials.modals')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>

    @stack('scripts')
</body>
</html>
