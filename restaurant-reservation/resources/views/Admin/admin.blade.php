<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - RestoReserve</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

     <!-- CSRF Token pour les requêtes AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Sidebar Navigation -->
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Modals -->
    @include('admin.partials.modals')

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
