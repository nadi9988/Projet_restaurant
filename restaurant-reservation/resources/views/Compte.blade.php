<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte | RestoReserve</title>
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
            --shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            --radius: 12px;
            --transition: all 0.3s ease;
            --max-width: 1200px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: var(--dark);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-size: 1.05rem;
        }

        /* Header */
        header {
            background-color: var(--secondary);
            color: white;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 1.2rem 2rem;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: var(--max-width);
            margin: 0 auto;
            width: 100%;
        }

        .logo {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo i {
            font-size: 1.8rem;
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            gap: 1.8rem;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            font-size: 1.1rem;
        }

        .nav-links a:hover {
            color: white;
            transform: translateY(-2px);
        }

        .nav-links a.active {
            color: white;
            font-weight: 600;
            border-bottom: 3px solid var(--primary);
        }

        .nav-links a i {
            font-size: 1rem;
        }

        /* Main Content - Centré */
        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2.5rem 2rem;
            max-width: var(--max-width);
            margin: 0 auto;
            width: 100%;
        }

        /* Profile Header - Centré et agrandi */
        .profile-header {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 3rem;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 3rem;
            border-top: 5px solid var(--primary);
        }

        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--primary);
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .profile-info {
            width: 100%;
        }

        .profile-name {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            color: var(--secondary);
        }

        .profile-email {
            color: var(--gray);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            font-size: 1.2rem;
        }

        .account-status {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background-color: var(--success);
            color: white;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .profile-meta {
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: var(--gray);
            font-size: 1.1rem;
        }

        .meta-item i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        /* Content Box - Centré et agrandi */
        .content-box {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 3rem;
            width: 100%;
            margin-bottom: 3rem;
            border-top: 5px solid var(--secondary);
        }

        .section-title {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            padding-bottom: 0.8rem;
            border-bottom: 3px solid var(--secondary-light);
            text-align: center;
        }

        .section-title i {
            color: var(--primary);
            font-size: 1.5rem;
        }

        /* Account Details - Centré et agrandi */
        .account-details {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .detail-card {
            background: var(--light);
            padding: 2rem;
            border-radius: var(--radius);
            border-left: 5px solid var(--primary);
            transition: var(--transition);
            text-align: center;
        }

        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .detail-label {
            font-size: 1.1rem;
            color: var(--gray);
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .detail-label i {
            font-size: 1rem;
            color: var(--primary);
        }

        .detail-value {
            font-size: 1.3rem;
            font-weight: 500;
        }

        .password-field {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .toggle-password {
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        /* Action Buttons - Centrés et agrandis */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 3rem;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: var(--radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 1.1rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(222, 116, 9, 0.3);
        }

        .btn-secondary {
            background-color: white;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-secondary:hover {
            background-color: var(--primary-light);
            transform: translateY(-3px);
        }

        .btn-danger {
            background-color: white;
            color: var(--danger);
            border: 2px solid var(--danger);
        }

        .btn-danger:hover {
            background-color: rgba(220, 53, 69, 0.1);
            transform: translateY(-3px);
        }

        /* Stats Cards - Centrées et agrandies */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
            width: 100%;
        }

        .stat-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
            border-top: 5px solid var(--primary);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.8rem;
        }

        .stat-label {
            color: var(--gray);
            font-size: 1.1rem;
        }

        /* Recent Reservations - Centré et agrandi */
        .reservations-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            font-size: 1.1rem;
        }

        .reservations-table th, 
        .reservations-table td {
            padding: 1.2rem;
            text-align: center;
            border-bottom: 2px solid var(--light);
        }

        .reservations-table th {
            background-color: var(--secondary);
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .reservations-table tr:hover {
            background-color: var(--primary-light);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
        }

        .status-confirmed {
            background-color: rgba(40, 167, 69, 0.2);
            color: var(--success);
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.2);
            color: var(--warning);
        }

        .status-cancelled {
            background-color: rgba(220, 53, 69, 0.2);
            color: var(--danger);
        }

        .table-action {
            color: var(--primary);
            transition: var(--transition);
            font-size: 1.2rem;
        }

        .table-action:hover {
            color: var(--primary-dark);
            transform: scale(1.2);
        }

        /* Footer - Agrandi */
        footer {
            background-color: var(--secondary);
            color: white;
            padding: 3rem 2rem;
            margin-top: auto;
        }

        .footer-content {
            max-width: var(--max-width);
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
        }

        .footer-column h3 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: white;
            text-align: center;
        }

        .footer-links {
            list-style: none;
            text-align: center;
        }

        .footer-links li {
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: var(--transition);
            font-size: 1.1rem;
        }

        .footer-links a:hover {
            color: white;
            text-decoration: underline;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .social-links a {
            color: white;
            font-size: 1.5rem;
            transition: var(--transition);
        }

        .social-links a:hover {
            color: var(--primary);
            transform: translateY(-3px) scale(1.1);
        }

        .copyright {
            text-align: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .navbar {
                flex-direction: column;
                gap: 1.5rem;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .profile-meta {
                gap: 1.5rem;
            }

            .account-details {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .profile-header {
                padding: 2.5rem 2rem;
            }

            .content-box {
                padding: 2.5rem 2rem;
            }

            .profile-meta {
                flex-direction: column;
                gap: 1rem;
            }

            .account-details {
                grid-template-columns: 1fr;
            }

            .stats-container {
                grid-template-columns: 1fr 1fr;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }

            .btn {
                width: 100%;
                max-width: 350px;
                justify-content: center;
            }

            .reservations-table {
                display: block;
                overflow-x: auto;
            }
        }

        @media (max-width: 576px) {
            body {
                font-size: 1rem;
            }

            .main-container {
                padding: 1.5rem 1rem;
            }

            .profile-header, .content-box {
                padding: 2rem 1.5rem;
            }

            .avatar {
                width: 120px;
                height: 120px;
            }

            .profile-name {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 1.5rem;
            }

            .stat-value {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <a href="#" class="logo">
                <i class="fas fa-utensils"></i>
                RestoReserve
            </a>
            <div class="nav-links">
                <a href="#"><i class="fas fa-home"></i> Accueil</a>
                <a href="#"><i class="fas fa-search"></i> Restaurants</a>
                <a href="#"><i class="fas fa-calendar-alt"></i> Réservations</a>
                <a href="#" class="active"><i class="fas fa-user"></i> Mon compte</a>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            </div>
        </div>
    </header>

    <div class="main-container">
        <!-- Profile Header - Centré et agrandi -->
        <div class="profile-header">
            <img src="https://ui-avatars.com/api/?name=Yassir+Kniksi&background=04134a&color=fff&size=150" alt="Avatar" class="avatar">
            <div class="profile-info">
                <h1 class="profile-name">Yassir Kniksi</h1>
                <p class="profile-email"><i class="fas fa-envelope"></i> yassirkniksi@gmail.com</p>
                <span class="account-status">Compte actif</span>
                
                <div class="profile-meta">
                    <div class="meta-item">
                        <i class="fas fa-phone"></i> 06 12 34 56 78
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-calendar-alt"></i> Membre depuis mars 2023
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-star"></i> Compte Premium
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards - Centrées et agrandies -->
        <div class="content-box">
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-value">24</div>
                    <div class="stat-label">Réservations</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">18</div>
                    <div class="stat-label">Visites</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">4.8</div>
                    <div class="stat-label">Évaluation</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value">12</div>
                    <div class="stat-label">Favoris</div>
                </div>
            </div>
        </div>

        <!-- Account Details - Centré et agrandi -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-info-circle"></i> Informations personnelles</h2>
            <div class="account-details">
                <div class="detail-card">
                    <div class="detail-label"><i class="fas fa-user"></i> Nom</div>
                    <div class="detail-value" id="lastName">Kniksi</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-label"><i class="fas fa-user"></i> Prénom</div>
                    <div class="detail-value" id="firstName">Yassir</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-label"><i class="fas fa-envelope"></i> Email</div>
                    <div class="detail-value" id="email">yassirkniksi@gmail.com</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-label"><i class="fas fa-phone"></i> Téléphone</div>
                    <div class="detail-value" id="telephone">06 12 34 56 78</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-label"><i class="fas fa-lock"></i> Mot de passe</div>
                    <div class="password-field">
                        <span class="detail-value password-mask">••••••••</span>
                        <button class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye"></i> Afficher
                        </button>
                    </div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-label"><i class="fas fa-calendar-plus"></i> Date d'inscription</div>
                    <div class="detail-value" id="InscriptionDate">18 avril 2025</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-label"><i class="fas fa-user-shield"></i> Statut</div>
                    <div class="detail-value" id="isActive">Actif</div>
                </div>
                
                <div class="detail-card">
                    <div class="detail-label"><i class="fas fa-star"></i> Type de compte</div>
                    <div class="detail-value" id="type">Premium</div>
                </div>
            </div>

            <!-- Action Buttons - Centrés et agrandis -->
            <div class="action-buttons">
                <button class="btn btn-primary"><i class="fas fa-edit"></i> Modifier le profil</button>
                <button class="btn btn-secondary"><i class="fas fa-key"></i> Changer le mot de passe</button>
                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer le compte</button>
            </div>
        </div>

        <!-- Recent Reservations - Centré et agrandi -->
        <div class="content-box">
            <h2 class="section-title"><i class="fas fa-history"></i> Dernières réservations</h2>
            <table class="reservations-table">
                <thead>
                    <tr>
                        <th>Restaurant</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Personnes</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Le Gourmet Parisien</td>
                        <td>10/06/2023</td>
                        <td>19:30</td>
                        <td>2</td>
                        <td><span class="status-badge status-confirmed">Confirmée</span></td>
                        <td><a href="#" class="table-action"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    <tr>
                        <td>La Petite Italie</td>
                        <td>05/06/2023</td>
                        <td>20:00</td>
                        <td>4</td>
                        <td><span class="status-badge status-confirmed">Confirmée</span></td>
                        <td><a href="#" class="table-action"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    <tr>
                        <td>Sushi Palace</td>
                        <td>28/05/2023</td>
                        <td>12:30</td>
                        <td>3</td>
                        <td><span class="status-badge status-cancelled">Annulée</span></td>
                        <td><a href="#" class="table-action"><i class="fas fa-eye"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>RestoReserve</h3>
                <p>La meilleure façon de réserver dans les restaurants de votre ville.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Liens utiles</h3>
                <ul class="footer-links">
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Restaurants</a></li>
                    <li><a href="#">Offres spéciales</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Aide</h3>
                <ul class="footer-links">
                    <li><a href="#">Centre d'aide</a></li>
                    <li><a href="#">Contactez-nous</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Conditions d'utilisation</a></li>
                </ul>
            </div>

        </div>
        <div class="copyright">
            © 2023 RestoReserve. Tous droits réservés.
        </div>
    </footer>

    <script>
        // Fonction pour afficher/masquer le mot de passe
        function togglePassword() {
            const passwordField = document.querySelector('.password-mask');
            const toggleBtn = document.querySelector('.toggle-password');
            
            if (passwordField.textContent === '••••••••') {
                passwordField.textContent = 'mysecretpassword';
                toggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i> Masquer';
            } else {
                passwordField.textContent = '••••••••';
                toggleBtn.innerHTML = '<i class="fas fa-eye"></i> Afficher';
            }
        }

        // Animation au chargement de la page
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.stat-card, .detail-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>
</html>