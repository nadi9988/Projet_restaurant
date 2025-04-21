<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur RestoReserve</title>
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
            color: white;
            line-height: 1.7;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header */
        header {
            background-color: var(--secondary);
            padding: 1.2rem 2rem;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
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
            color: var(--primary);
            font-size: 1.8rem;
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

        /* Hero Section */
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 4rem 2rem;
            position: relative;
        }

        .hero-content {
            max-width: 800px;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 3rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        /* Boutons */
        .btn-group {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1.2rem 2.5rem;
            border-radius: var(--radius);
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: 2px solid var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(222, 116, 9, 0.3);
        }

        .btn-secondary {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }

        /* Features Section */
        .features {
            background-color: rgba(255, 255, 255, 0.95);
            color: var(--secondary);
            padding: 4rem 2rem;
        }

        .features-container {
            max-width: var(--max-width);
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2.5rem;
            color: var(--secondary);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
        }

        .feature-card {
            background: white;
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--secondary);
        }

        /* Footer */
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
            color: var(--primary);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: white;
            text-decoration: underline;
        }

        .social-links {
            display: flex;
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
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.7);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.2rem;
            }
            
            .navbar {
                flex-direction: column;
                gap: 1.5rem;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .btn-group {
                flex-direction: column;
                gap: 1rem;
            }
            
            .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .section-title {
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
                <a href="#" class="active"><i class="fas fa-home"></i> Accueil</a>
                <a href="#features"><i class="fas fa-star"></i> Fonctionnalités</a>
                <a href="login.html"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                <a href="register.html"><i class="fas fa-user-plus"></i> Inscription</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Réservez votre table en toute simplicité</h1>
            <p>Découvrez les meilleurs restaurants près de chez vous et réservez en quelques clics</p>
            <div class="btn-group">
                <a href="register.html" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i>
                    S'inscrire gratuitement
                </a>
                <a href="#features" class="btn btn-secondary">
                    <i class="fas fa-info-circle"></i>
                    En savoir plus
                </a>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="features-container">
            <h2 class="section-title">Pourquoi choisir RestoReserve ?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Réservation instantanée</h3>
                    <p>Réservez en temps réel votre table dans les meilleurs restaurants sans attente.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <h3>Offres exclusives</h3>
                    <p>Bénéficiez de promotions réservées aux membres de notre plateforme.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Disponible partout</h3>
                    <p>Accédez à notre service depuis votre smartphone, tablette ou ordinateur.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>RestoReserve</h3>
                <p>La solution simple et efficace pour réserver dans les meilleurs restaurants.</p>
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
                    <li><a href="#features">Fonctionnalités</a></li>
                    <li><a href="login.html">Connexion</a></li>
                    <li><a href="register.html">Inscription</a></li>
                </ul>
            </div>
            

        </div>
        
        <div class="copyright">
            © 2025 RestoReserve. Tous droits réservés.
        </div>
    </footer>

    <script>
        // Animation au défilement
        document.addEventListener('DOMContentLoaded', () => {
            const featureCards = document.querySelectorAll('.feature-card');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            featureCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease-out';
                observer.observe(card);
            });
            
            // Animation des liens de navigation
            const navLinks = document.querySelectorAll('.nav-links a');
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', () => {
                    link.style.transform = 'translateY(-3px)';
                });
                link.addEventListener('mouseleave', () => {
                    link.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>