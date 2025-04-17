<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <h2 class="mb-4 text-center">Créer un compte</h2>

                {{-- Affichage des erreurs de validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulaire d'inscription --}}
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="lastName" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" required>
                    </div>

                    <div class="mb-3">
                        <label for="firstName" class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" name="telephone" id="telephone">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Créer mon compte</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ url('/login') }}">Déjà un compte ? Se connecter</a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
