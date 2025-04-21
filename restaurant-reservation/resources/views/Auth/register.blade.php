<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - RestoReserve</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #de7409; /* Orange */
            --primary-dark: #b35d07;
            --primary-light: rgba(222, 116, 9, 0.1);
            --secondary: #04134a; /* Bleu foncé */
            --secondary-light: rgba(4, 19, 74, 0.1);
            --light: #f8f9fa;
            --dark: #333333;
            --gray: #95a5a6;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            --radius: 16px;
            --transition: all 0.3s ease;
            --max-width: 1400px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: linear-gradient(rgba(4, 19, 74, 0.6), rgba(4, 19, 74, 0.6)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            color: var(--dark);
            line-height: 1.7;
        }

        /* Conteneur principal */
        .register-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 500px;
            text-align: center;
            backdrop-filter: blur(4px);
            border-top: 6px solid var(--primary);
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* En-tête */
        .register-header {
            margin-bottom: 2rem;
        }

        .register-header h1 {
            color: var(--secondary);
            font-size: 2rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .register-header i {
            color: var(--primary);
            font-size: 1.8rem;
        }

        .register-header p {
            color: var(--gray);
            font-size: 1rem;
        }

        /* Formulaire */
        .form-group {
            margin-bottom: 1.2rem;
            text-align: left;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--secondary);
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: var(--radius);
            font-size: 1rem;
            transition: var(--transition);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 4px rgba(222, 116, 9, 0.2);
        }

        .form-group input::placeholder {
            color: var(--gray);
            opacity: 0.7;
        }

        /* Nouveau style pour le bouton Afficher/Masquer */
        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--gray);
            font-size: 0.9rem;
            transition: var(--transition);
            background: none;
            border: none;
            padding: 0 0.5rem;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .toggle-password:hover {
            color: var(--primary);
        }

        /* Options */
        .checkbox-group {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .checkbox-group input {
            margin-right: 0.75rem;
            width: auto;
            accent-color: var(--primary);
            width: 18px;
            height: 18px;
        }

        .checkbox-group label {
            font-weight: normal;
            color: var(--gray);
            font-size: 0.9rem;
            cursor: pointer;
            user-select: none;
        }

        /* Bouton */
        .register-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 1.2rem;
            width: 100%;
            border-radius: var(--radius);
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 1.5rem 0;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .register-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(222, 116, 9, 0.3);
        }

        /* Lien connexion */
        .login-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 1rem;
            display: inline-block;
            margin-bottom: 1rem;
            transition: var(--transition);
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .login-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Pied de page */
        .footer {
            font-size: 0.8rem;
            color: var(--gray);
            margin-top: 2rem;
            line-height: 1.5;
            text-align: center;
        }

        /* Message d'erreur */
        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: none;
            font-weight: 500;
        }

        /* Layout à deux colonnes */
        .row {
            display: flex;
            gap: 1rem;
        }
        
        .col {
            flex: 1;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .register-container {
                padding: 1.5rem;
            }
            
            .row {
                flex-direction: column;
                gap: 0;
            }
            
            .register-header h1 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1><i class="fas fa-user-plus"></i> Créer un compte</h1>
            
        </div>
        
        <form id="registerForm">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="lastName">Nom</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Votre nom" required>
                        <div class="error-message" id="lastName-error"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="firstName">Prénom</label>
                        <input type="text" id="firstName" name="firstName" placeholder="Votre prénom" required>
                        <div class="error-message" id="firstName-error"></div>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" placeholder="exemple@domaine.com" required>
                <div class="error-message" id="email-error"></div>
            </div>
            
            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" placeholder="06 12 34 56 78">
            </div>
            
            <div class="form-group">
                <label for="InscriptionDate">Date d'inscription</label>
                <input type="date" id="InscriptionDate" name="InscriptionDate">
            </div>
            
            <div class="form-group">
                <label for="type">Type d'utilisateur</label>
                <select id="type" name="type">
                    <option value="utilisateur">Utilisateur</option>
                    <option value="admin">Administrateur</option>
                </select>
            </div>
            
            <div class="checkbox-group">
                <input type="checkbox" id="isActive" name="isActive">
                <label for="isActive">Activer le compte immédiatement</label>
            </div>
            
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="••••••••" required style="padding-right: 85px;">
                    <button type="button" class="toggle-password" onclick="togglePassword('password', this)">
                        <i class="fas fa-eye"></i> <span>Afficher</span>
                    </button>
                </div>
                <div class="error-message" id="password-error"></div>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <div class="password-container">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required style="padding-right: 85px;">
                    <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)">
                        <i class="fas fa-eye"></i> <span>Afficher</span>
                    </button>
                </div>
                <div class="error-message" id="password-confirm-error"></div>
            </div>
            
            <button type="submit" class="register-btn">
                <i class="fas fa-user-plus"></i>
                S'inscrire
            </button>
            
            <div class="text-center">
                <a href="login.html" class="login-link">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </a>
            </div>
        </form>
        
        <div class="footer">
            &copy; 2025 RestoReserve - Tous droits réservés<br>
            <small>Version 1.0.0</small>
        </div>
    </div>

    <script>
        // Fonction pour basculer entre afficher/masquer le mot de passe
        function togglePassword(inputId, toggleElement) {
            const passwordInput = document.getElementById(inputId);
            const icon = toggleElement.querySelector('i');
            const textSpan = toggleElement.querySelector('span');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
                textSpan.textContent = 'Masquer';
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
                textSpan.textContent = 'Afficher';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Validation améliorée du formulaire
            document.getElementById('registerForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const firstName = document.getElementById('firstName').value.trim();
                const lastName = document.getElementById('lastName').value.trim();
                const email = document.getElementById('email').value.trim();
                const password = document.getElementById('password').value.trim();
                const passwordConfirm = document.getElementById('password_confirmation').value.trim();
                let isValid = true;
                
                // Réinitialiser les messages d'erreur
                document.querySelectorAll('.error-message').forEach(el => {
                    el.style.display = 'none';
                });
                
                // Validation prénom
                if (!firstName) {
                    document.getElementById('firstName-error').textContent = 'Veuillez entrer votre prénom';
                    document.getElementById('firstName-error').style.display = 'block';
                    isValid = false;
                } else if (firstName.length < 2) {
                    document.getElementById('firstName-error').textContent = 'Le prénom doit contenir au moins 2 caractères';
                    document.getElementById('firstName-error').style.display = 'block';
                    isValid = false;
                }
                
                // Validation nom
                if (!lastName) {
                    document.getElementById('lastName-error').textContent = 'Veuillez entrer votre nom';
                    document.getElementById('lastName-error').style.display = 'block';
                    isValid = false;
                } else if (lastName.length < 2) {
                    document.getElementById('lastName-error').textContent = 'Le nom doit contenir au moins 2 caractères';
                    document.getElementById('lastName-error').style.display = 'block';
                    isValid = false;
                }
                
                // Validation email
                if (!email) {
                    document.getElementById('email-error').textContent = 'Veuillez entrer votre email';
                    document.getElementById('email-error').style.display = 'block';
                    isValid = false;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    document.getElementById('email-error').textContent = 'Veuillez entrer un email valide';
                    document.getElementById('email-error').style.display = 'block';
                    isValid = false;
                }
                
                // Validation mot de passe
                if (!password) {
                    document.getElementById('password-error').textContent = 'Veuillez entrer un mot de passe';
                    document.getElementById('password-error').style.display = 'block';
                    isValid = false;
                } else if (password.length < 8) {
                    document.getElementById('password-error').textContent = 'Le mot de passe doit contenir au moins 8 caractères';
                    document.getElementById('password-error').style.display = 'block';
                    isValid = false;
                } else if (!/[A-Z]/.test(password)) {
                    document.getElementById('password-error').textContent = 'Le mot de passe doit contenir au moins une majuscule';
                    document.getElementById('password-error').style.display = 'block';
                    isValid = false;
                } else if (!/[0-9]/.test(password)) {
                    document.getElementById('password-error').textContent = 'Le mot de passe doit contenir au moins un chiffre';
                    document.getElementById('password-error').style.display = 'block';
                    isValid = false;
                }
                
                // Validation confirmation mot de passe
                if (password !== passwordConfirm) {
                    document.getElementById('password-confirm-error').textContent = 'Les mots de passe ne correspondent pas';
                    document.getElementById('password-confirm-error').style.display = 'block';
                    isValid = false;
                }
                
                // Si tout est valide, soumettre le formulaire
                if (isValid) {
                    // Simuler une soumission réussie
                    const submitBtn = document.querySelector('.register-btn');
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Inscription en cours...';
                    submitBtn.disabled = true;
                    
                    setTimeout(() => {
                        alert('Inscription réussie ! Bienvenue sur RestoReserve.');
                        // this.submit(); // Décommentez pour une vraie soumission
                    }, 1500);
                }
            });
            
            // Animation des champs du formulaire
            const formGroups = document.querySelectorAll('.form-group, .checkbox-group');
            formGroups.forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateY(20px)';
                group.style.transition = 'all 0.4s ease-out';
                
                setTimeout(() => {
                    group.style.opacity = '1';
                    group.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>
</html>