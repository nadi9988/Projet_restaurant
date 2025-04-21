<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoReserve - Réservation en ligne de restaurants</title>
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
            --section-padding: 4rem;
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
            line-height: 1.7;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-size: 1.15rem;
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


        /* Bannière principale */
        .hero {
            background-image: linear-gradient(rgba(4, 19, 74, 0.6), rgba(4, 19, 74, 0.6)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 70vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 0 1rem;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            max-width: 900px;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.5rem;
            max-width: 700px;
            margin-bottom: 3rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        /* Formulaire de recherche */
        .search-box {
            background: rgba(255,255,255,0.95);
            padding: 3rem;
            border-radius: var(--radius);
            width: 90%;
            max-width: 900px;
            margin-top: 2rem;
            box-shadow: var(--shadow);
            border-top: 6px solid var(--primary);
        }

        .search-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 1.5rem;
        }

        input, select {
            padding: 1.2rem;
            border: 2px solid #ddd;
            border-radius: var(--radius);
            font-size: 1.1rem;
            transition: var(--transition);
        }

        input:focus, select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 4px rgba(222, 116, 9, 0.2);
        }

        button.search-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            font-size: 1.2rem;
            padding: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        button.search-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(222, 116, 9, 0.3);
        }

        /* Section promotions */
        .promotions {
            padding: var(--section-padding) 2rem;
            background-color: var(--light);
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2.5rem;
            color: var(--secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
        }

        .section-title i {
            color: var(--primary);
            font-size: 2rem;
        }

        .promo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 3rem;
            max-width: var(--max-width);
            margin: 0 auto;
        }

        .promo-card {
            border: 1px solid #eee;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            position: relative;
            transition: var(--transition);
            background: white;
        }

        .promo-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .promo-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--primary);
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 30px;
            font-weight: bold;
            z-index: 2;
            font-size: 1.1rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        .promo-img {
            height: 250px;
            background-size: cover;
            background-position: center;
        }

        .promo-info {
            padding: 2rem;
        }

        .promo-info h3 {
            margin-top: 0;
            color: var(--secondary);
            font-size: 1.6rem;
            margin-bottom: 1rem;
        }

        .promo-info p {
            margin: 1rem 0;
            color: var(--gray);
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .validity {
            font-style: italic;
            color: var(--gray);
            font-size: 1rem;
            margin: 1rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .validity i {
            color: var(--primary);
        }

        .promo-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius);
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            margin-top: 1.5rem;
        }

        .promo-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(222, 116, 9, 0.3);
        }

        /* Section restaurants */
        .restaurants {
            padding: var(--section-padding) 2rem;
            max-width: var(--max-width);
            margin: 0 auto;
            width: 100%;
        }

        .restaurant-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 3rem;
            margin-top: 3rem;
        }

        .restaurant-card {
            border: 1px solid #eee;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            background: white;
        }

        .restaurant-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .restaurant-img {
            height: 250px;
            background-size: cover;
            background-position: center;
        }

        .restaurant-info {
            padding: 2rem;
        }

        .restaurant-title {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 1rem;
        }

        .restaurant-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .restaurant-info h3 {
            margin: 0;
            color: var(--secondary);
            font-size: 1.6rem;
        }

        .restaurant-info p {
            margin: 0.8rem 0;
            color: var(--gray);
            font-size: 1.1rem;
        }

        .rating {
            color: var(--warning);
            font-weight: bold;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Nouveau style pour les boutons */
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .profile-btn, .reserve-btn {
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            width: 100%;
        }

        .profile-btn {
            background-color: white;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .profile-btn:hover {
            background-color: var(--primary-light);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(222, 116, 9, 0.1);
        }

        .reserve-btn {
            background-color: var(--primary);
            color: white;
            border: 2px solid var(--primary);
        }

        .reserve-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(222, 116, 9, 0.3);
        }

        /* Pied de page */
        footer {
            background-color: var(--secondary);
            color: white;
            padding: 4rem 3rem;
            margin-top: auto;
        }

        .footer-content {
            max-width: var(--max-width);
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 4rem;
        }

        .footer-column h3 {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: white;
            text-align: center;
        }

        .footer-links {
            list-style: none;
            text-align: center;
        }

        .footer-links li {
            margin-bottom: 1.5rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: var(--transition);
            font-size: 1.2rem;
        }

        .footer-links a:hover {
            color: white;
            text-decoration: underline;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .social-links a {
            color: white;
            font-size: 1.8rem;
            transition: var(--transition);
        }

        .social-links a:hover {
            color: var(--primary);
            transform: translateY(-5px) scale(1.1);
        }

        .copyright {
            text-align: center;
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 3px solid rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            :root {
                --section-padding: 3.5rem;
            }
            
            .hero h1 {
                font-size: 3rem;
            }
            
            .search-form {
                grid-template-columns: 1fr 1fr;
            }
            
            button.search-btn {
                grid-column: span 2;
            }
        }

        @media (max-width: 992px) {
            :root {
                --section-padding: 3rem;
            }
            
            .navbar {
                flex-direction: column;
                gap: 2rem;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .promo-grid, .restaurant-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }

        @media (max-width: 768px) {
            :root {
                --section-padding: 2.5rem;
                --radius: 14px;
            }
            
            header {
                padding: 1.2rem 2rem;
            }
            
            .hero {
                height: 80vh;
            }
            
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1.2rem;
            }
            
            .search-box {
                padding: 2rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .promo-img, .restaurant-img {
                height: 200px;
            }
        }

        @media (max-width: 576px) {
            :root {
                --section-padding: 2rem;
            }
            
            .hero h1 {
                font-size: 1.8rem;
            }
            
            .section-title {
                font-size: 1.8rem;
                flex-direction: column;
                gap: 1rem;
            }
            
            .promo-grid, .restaurant-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 3rem;
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
                <a href="#"><i class="fas fa-search"></i> Restaurants</a>
                <a href="#"><i class="fas fa-calendar-alt"></i> Réservations</a>
                <a href="#"><i class="fas fa-user"></i> Mon compte</a>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <h2>Réservez votre table dans les meilleurs restaurants</h2>
        <p>Découvrez une expérience culinaire exceptionnelle près de chez vous</p>
        
        <div class="search-box">
            <form class="search-form" action="/recherche" method="GET">
                <input type="text" placeholder="Rechercher un restaurant, une cuisine...">
                <select name="personnes">
                    <option value="" selected disabled>Nombre de personnes</option>
                    <option value="1">1 personne</option>
                    <option value="2">2 personnes</option>
                    <option value="3">3 personnes</option>
                    <option value="4">4 personnes</option>
                    <option value="5+">5+ personnes</option>
                </select>
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>
                    Rechercher
                </button>
            </form>
        </div>
    </section>

    <section class="promotions">
        <h2 class="section-title">
            <i class="fas fa-percentage"></i>
            Nos promotions du moment
        </h2>
        <div class="promo-grid">
            <div class="promo-card">
                <div class="promo-badge">-20%</div>
                <div class="promo-img" style="background-image: url('https://images.unsplash.com/photo-1544025162-d76694265947?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
                <div class="promo-info">
                    <h3>Dîner en amoureux</h3>
                    <p>Menu spécial Saint-Valentin avec vin offert pour toute réservation de 2 personnes</p>
                    <p class="validity"><i class="fas fa-calendar-alt"></i> Valable jusqu'au 14/02</p>
                    <button class="promo-btn">
                        <i class="fas fa-eye"></i>
                        Voir le menu
                    </button>
                </div>
            </div>
            
            <div class="promo-card">
                <div class="promo-badge">-15%</div>
                <div class="promo-img" style="background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
                <div class="promo-info">
                    <h3>Déjeuner d'affaires</h3>
                    <p>Formule rapide du lundi au vendredi avec entrée + plat ou plat + dessert</p>
                    <p class="validity"><i class="fas fa-clock"></i> Valable de 12h à 14h en semaine</p>
                    <button class="promo-btn">
                        <i class="fas fa-calendar-check"></i>
                        Réserver
                    </button>
                </div>
            </div>
            
            <div class="promo-card">
                <div class="promo-badge">1 Plat OFFERT</div>
                <div class="promo-img" style="background-image: url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
                <div class="promo-info">
                    <h3>Première visite</h3>
                    <p>Un plat offert au choix pour votre première réservation dans ce restaurant</p>
                    <p class="validity"><i class="fas fa-user-plus"></i> Nouveaux clients uniquement</p>
                    <button class="promo-btn">
                        <i class="fas fa-gift"></i>
                        Profiter de l'offre
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="restaurants">
        <h2 class="section-title">
            <i class="fas fa-utensils"></i>
            Nos restaurants partenaires
        </h2>
        <div class="restaurant-grid">
            <div class="restaurant-card">
                <div class="restaurant-img" style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
                <div class="restaurant-info">
                    <div class="restaurant-title">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="Le Gourmet Parisien" class="restaurant-logo">
                        <h3>Le Gourmet Parisien</h3>
                    </div>
                    <p><i class="fas fa-flag"></i> Cuisine française • $$$</p>
                    <p class="rating"><i class="fas fa-star"></i> ★★★★☆ (128 avis)</p>
                    <div class="action-buttons">
                        <button class="profile-btn">
                            <i class="fas fa-eye"></i>
                            Voir le profil
                        </button>
                        <button class="reserve-btn">
                            <i class="fas fa-calendar-alt"></i>
                            Réserver
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="restaurant-card">
                <div class="restaurant-img" style="background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
                <div class="restaurant-info">
                    <div class="restaurant-title">
                        <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="La Pasta Bella" class="restaurant-logo">
                        <h3>La Pasta Bella</h3>
                    </div>
                    <p><i class="fas fa-flag"></i> Cuisine italienne • $$</p>
                    <p class="rating"><i class="fas fa-star"></i> ★★★★★ (95 avis)</p>
                    <div class="action-buttons">
                        <button class="profile-btn">
                            <i class="fas fa-eye"></i>
                            Voir le profil
                        </button>
                        <button class="reserve-btn">
                            <i class="fas fa-calendar-alt"></i>
                            Réserver
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="restaurant-card">
                <div class="restaurant-img" style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
                <div class="restaurant-info">
                    <div class="restaurant-title">
                        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="Tokyo Sushi" class="restaurant-logo">
                        <h3>Tokyo Sushi</h3>
                    </div>
                    <p><i class="fas fa-flag"></i> Cuisine japonaise • $$$</p>
                    <p class="rating"><i class="fas fa-star"></i> ★★★★☆ (156 avis)</p>
                    <div class="action-buttons">
                        <button class="profile-btn">
                            <i class="fas fa-eye"></i>
                            Voir le profil
                        </button>
                        <button class="reserve-btn">
                            <i class="fas fa-calendar-alt"></i>
                            Réserver
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>RestoReserve</h3>
                <p>La meilleure façon de réserver dans les restaurants de votre ville.</p>

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
        // Animation au chargement de la page
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('.promo-card, .restaurant-card');
            elements.forEach((element, index) => {
                setTimeout(() => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>
</html>