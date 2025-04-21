<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - RestoReserve</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #de7409;
            --primary-dark: #b35d07;
            --secondary: #04134a;
            --light: #f8f9fa;
            --dark: #333333;
            --gray: #95a5a6;
            --success: #28a745;
            --danger: #dc3545;
            --shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            --radius: 16px;
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
            line-height: 1.7;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        /* Main Content */
        .container {
            max-width: var(--max-width);
            margin: 2rem auto;
            padding: 0 2rem;
            flex: 1;
            width: 100%;
        }

        .reservation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .page-title i {
            color: var(--primary);
        }

        /* Restaurant Checkbox List */
        .restaurant-selection {
            background: white;
            border-radius: var(--radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
        }

        .restaurant-selection h3 {
            margin-bottom: 1rem;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .restaurant-options {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .restaurant-option {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            border-radius: var(--radius);
            transition: var(--transition);
            cursor: pointer;
            border: 1px solid #e0e0e0;
        }

        .restaurant-option:hover {
            border-color: var(--primary);
        }

        .restaurant-option input {
            margin-right: 1rem;
            accent-color: var(--primary);
            width: 18px;
            height: 18px;
        }

        .restaurant-info {
            flex: 1;
        }

        .restaurant-info h4 {
            color: var(--secondary);
            margin-bottom: 0.3rem;
        }

        .restaurant-info p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        /* Reservation Card */
        .reservation-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .reservation-type-tabs {
            display: flex;
            border-bottom: 2px solid var(--primary-light);
        }

        .tab {
            padding: 1rem 2rem;
            cursor: pointer;
            font-weight: 600;
            text-align: center;
            flex: 1;
            transition: var(--transition);
            border-bottom: 3px solid transparent;
        }

        .tab.active {
            border-bottom: 3px solid var(--primary);
            color: var(--primary);
        }

        .tab-content {
            display: none;
            padding: 2rem;
        }

        .tab-content.active {
            display: block;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: var(--radius);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 4px rgba(222, 116, 9, 0.2);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        /* Table Selection */
        .tables-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .table-card {
            border: 2px solid #e0e0e0;
            border-radius: var(--radius);
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .table-card:hover {
            border-color: var(--primary);
        }

        .table-card.selected {
            border-color: var(--primary);
            background-color: rgba(222, 116, 9, 0.1);
        }

        .table-card.unavailable {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: #f8f9fa;
        }

        /* Client Information Section */
        .client-section {
            background: white;
            border-radius: var(--radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .client-section h3 {
            margin-bottom: 1.5rem;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Pre-commande Section */
        .precommande-section {
            background: white;
            border-radius: var(--radius);
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
        }

        .precommande-section h3 {
            margin-bottom: 1.5rem;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .menu-items {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .menu-item {
            border: 1px solid #e0e0e0;
            border-radius: var(--radius);
            padding: 1rem;
            transition: var(--transition);
        }

        .menu-item:hover {
            border-color: var(--primary);
        }

        .menu-item-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .menu-item-title {
            font-weight: 600;
            color: var(--secondary);
        }

        .menu-item-price {
            color: var(--primary);
            font-weight: 600;
        }

        .menu-item-description {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .menu-item-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            padding: 0.3rem;
            border: 1px solid #e0e0e0;
            border-radius: var(--radius);
        }

        /* Submit Button */
        .submit-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 1.2rem;
            width: 100%;
            border-radius: var(--radius);
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .submit-btn:hover {
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

    <div class="container">
        <div class="reservation-header">
            <h1 class="page-title">
                <i class="fas fa-calendar-plus"></i>
                Réserver une table
            </h1>
        </div>

        <!-- Section sélection du restaurant -->
        <div class="restaurant-selection">
            <h3><i class="fas fa-store"></i> Sélectionnez un restaurant</h3>
            <div class="restaurant-options">
                <label class="restaurant-option">
                    <input type="radio" name="restaurant" value="1" checked>
                    <div class="restaurant-info">
                        <h4>Le Gourmet Parisien</h4>
                        <p>Cuisine française • Paris 8ème</p>
                    </div>
                </label>
                
                <label class="restaurant-option">
                    <input type="radio" name="restaurant" value="2">
                    <div class="restaurant-info">
                        <h4>La Pasta Bella</h4>
                        <p>Cuisine italienne • Paris 5ème</p>
                    </div>
                </label>
                
                <label class="restaurant-option">
                    <input type="radio" name="restaurant" value="3">
                    <div class="restaurant-info">
                        <h4>Tokyo Sushi</h4>
                        <p>Cuisine japonaise • Paris 2ème</p>
                    </div>
                </label>
            </div>
        </div>

        <!-- Section informations client -->
        <div class="client-section">
            <h3><i class="fas fa-user"></i> Informations personnelles</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="client-name">Nom complet</label>
                    <input type="text" id="client-name" name="client_name" required>
                </div>
                <div class="form-group">
                    <label for="client-email">Email</label>
                    <input type="email" id="client-email" name="client_email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="client-phone">Téléphone</label>
                    <input type="tel" id="client-phone" name="client_phone" required>
                </div>
                <div class="form-group">
                    <label for="client-notes">Notes supplémentaires</label>
                    <input type="text" id="client-notes" name="client_notes" placeholder="Allergies, anniversaire...">
                </div>
            </div>
        </div>

        <div class="reservation-card">
            <div class="reservation-type-tabs">
                <div class="tab active" data-tab="specific-table">
                    <i class="fas fa-chair"></i> Choix de table
                </div>
                <div class="tab" data-tab="general-reservation">
                    <i class="fas fa-utensils"></i> Réservation générale
                </div>
            </div>

            <!-- Formulaire avec choix de table spécifique -->
            <div id="specific-table" class="tab-content active">
                <form id="tableReservationForm">
                    <input type="hidden" name="reservation_type" value="table">
                    <input type="hidden" name="restaurant_id" value="1">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="table-date">Date</label>
                            <input type="date" id="table-date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="table-time">Heure</label>
                            <input type="time" id="table-time" name="time" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="table-capacity">Nombre de personnes</label>
                        <select id="table-capacity" name="number_of_people" required>
                            <option value="">Sélectionnez...</option>
                            <option value="2">2 personnes</option>
                            <option value="4">4 personnes</option>
                            <option value="6">6 personnes</option>
                            <option value="8">8+ personnes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tables disponibles</label>
                        <div class="tables-grid" id="available-tables">
                            <div class="table-card" data-table-id="1" data-capacity="4">
                                <h3>Table 1</h3>
                                <p>4 personnes</p>
                                <p class="table-status available">Disponible</p>
                            </div>
                            <div class="table-card" data-table-id="2" data-capacity="6">
                                <h3>Table 2</h3>
                                <p>6 personnes</p>
                                <p class="table-status available">Disponible</p>
                            </div>
                            <div class="table-card unavailable" data-table-id="3">
                                <h3>Table 3</h3>
                                <p>4 personnes</p>
                                <p class="table-status">Indisponible</p>
                            </div>
                            <div class="table-card" data-table-id="4" data-capacity="2">
                                <h3>Table 4</h3>
                                <p>2 personnes</p>
                                <p class="table-status available">Disponible</p>
                            </div>
                        </div>
                        <input type="hidden" name="table_id" id="selected-table">
                    </div>

                    <!-- Section pré-commande intégrée dans le formulaire -->
                    <div class="precommande-section">
                        <h3><i class="fas fa-utensils"></i> Pré-commander des plats (optionnel)</h3>
                        <div class="menu-items">
                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <span class="menu-item-title">Entrée - Salade César</span>
                                    <span class="menu-item-price">12€</span>
                                </div>
                                <p class="menu-item-description">Laitue romaine, croûtons, parmesan, sauce césar</p>
                                <div class="menu-item-controls">
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn minus" data-item="entree-cesar">-</button>
                                        <input type="number" class="quantity-input" id="entree-cesar" name="entree_cesar" value="0" min="0">
                                        <button type="button" class="quantity-btn plus" data-item="entree-cesar">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <span class="menu-item-title">Plat - Filet de boeuf</span>
                                    <span class="menu-item-price">28€</span>
                                </div>
                                <p class="menu-item-description">Avec frites maison et sauce au choix</p>
                                <div class="menu-item-controls">
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn minus" data-item="plat-boeuf">-</button>
                                        <input type="number" class="quantity-input" id="plat-boeuf" name="plat_boeuf" value="0" min="0">
                                        <button type="button" class="quantity-btn plus" data-item="plat-boeuf">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <span class="menu-item-title">Dessert - Fondant au chocolat</span>
                                    <span class="menu-item-price">9€</span>
                                </div>
                                <p class="menu-item-description">Coulant avec glace vanille</p>
                                <div class="menu-item-controls">
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn minus" data-item="dessert-chocolat">-</button>
                                        <input type="number" class="quantity-input" id="dessert-chocolat" name="dessert_chocolat" value="0" min="0">
                                        <button type="button" class="quantity-btn plus" data-item="dessert-chocolat">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <span class="menu-item-title">Boisson - Bouteille de vin</span>
                                    <span class="menu-item-price">35€</span>
                                </div>
                                <p class="menu-item-description">Bordeaux rouge 2018</p>
                                <div class="menu-item-controls">
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn minus" data-item="boisson-vin">-</button>
                                        <input type="number" class="quantity-input" id="boisson-vin" name="boisson_vin" value="0" min="0">
                                        <button type="button" class="quantity-btn plus" data-item="boisson-vin">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-calendar-check"></i>
                        Réserver cette table
                    </button>
                </form>
            </div>

            <!-- Formulaire de réservation générale -->
            <div id="general-reservation" class="tab-content">
                <form id="generalReservationForm">
                    <input type="hidden" name="reservation_type" value="general">
                    <input type="hidden" name="restaurant_id" value="1">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="general-date">Date</label>
                            <input type="date" id="general-date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="general-time">Heure</label>
                            <input type="time" id="general-time" name="time" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="general-people">Nombre de personnes</label>
                            <select id="general-people" name="number_of_people" required>
                                <option value="">Sélectionnez...</option>
                                <option value="1">1 personne</option>
                                <option value="2">2 personnes</option>
                                <option value="3">3 personnes</option>
                                <option value="4">4 personnes</option>
                                <option value="5">5 personnes</option>
                                <option value="6">6 personnes</option>
                                <option value="7">7 personnes</option>
                                <option value="8">8+ personnes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="general-preference">Préférence</label>
                            <select id="general-preference" name="preference">
                                <option value="">Aucune préférence</option>
                                <option value="window">Près de la fenêtre</option>
                                <option value="terrace">Terrasse</option>
                                <option value="quiet">Zone calme</option>
                            </select>
                        </div>
                    </div>

                    <!-- Section pré-commande intégrée dans le formulaire général -->
                    <div class="precommande-section">
                        <h3><i class="fas fa-utensils"></i> Pré-commander des plats (optionnel)</h3>
                        <div class="menu-items">
                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <span class="menu-item-title">Entrée - Salade César</span>
                                    <span class="menu-item-price">12€</span>
                                </div>
                                <p class="menu-item-description">Laitue romaine, croûtons, parmesan, sauce césar</p>
                                <div class="menu-item-controls">
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn minus" data-item="entree-cesar-general">-</button>
                                        <input type="number" class="quantity-input" id="entree-cesar-general" name="entree_cesar" value="0" min="0">
                                        <button type="button" class="quantity-btn plus" data-item="entree-cesar-general">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <span class="menu-item-title">Plat - Filet de boeuf</span>
                                    <span class="menu-item-price">28€</span>
                                </div>
                                <p class="menu-item-description">Avec frites maison et sauce au choix</p>
                                <div class="menu-item-controls">
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn minus" data-item="plat-boeuf-general">-</button>
                                        <input type="number" class="quantity-input" id="plat-boeuf-general" name="plat_boeuf" value="0" min="0">
                                        <button type="button" class="quantity-btn plus" data-item="plat-boeuf-general">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <span class="menu-item-title">Dessert - Fondant au chocolat</span>
                                    <span class="menu-item-price">9€</span>
                                </div>
                                <p class="menu-item-description">Coulant avec glace vanille</p>
                                <div class="menu-item-controls">
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn minus" data-item="dessert-chocolat-general">-</button>
                                        <input type="number" class="quantity-input" id="dessert-chocolat-general" name="dessert_chocolat" value="0" min="0">
                                        <button type="button" class="quantity-btn plus" data-item="dessert-chocolat-general">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="menu-item">
                                <div class="menu-item-header">
                                    <span class="menu-item-title">Boisson - Bouteille de vin</span>
                                    <span class="menu-item-price">35€</span>
                                </div>
                                <p class="menu-item-description">Bordeaux rouge 2018</p>
                                <div class="menu-item-controls">
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn minus" data-item="boisson-vin-general">-</button>
                                        <input type="number" class="quantity-input" id="boisson-vin-general" name="boisson_vin" value="0" min="0">
                                        <button type="button" class="quantity-btn plus" data-item="boisson-vin-general">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-calendar-check"></i>
                        Réserver sans choisir de table
                    </button>
                </form>
            </div>
        </div>
    </div>

    <footer>

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
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des onglets
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Désactiver tous les onglets
                    tabs.forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                    
                    // Activer l'onglet cliqué
                    this.classList.add('active');
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });

            // Sélection des tables
            const tableCards = document.querySelectorAll('.table-card:not(.unavailable)');
            tableCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Désélectionner toutes les tables
                    document.querySelectorAll('.table-card').forEach(t => t.classList.remove('selected'));
                    
                    // Sélectionner la table cliquée
                    this.classList.add('selected');
                    document.getElementById('selected-table').value = this.getAttribute('data-table-id');
                });
            });

            // Gestion des quantités de pré-commande
            document.querySelectorAll('.quantity-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-item');
                    const input = document.getElementById(itemId);
                    let value = parseInt(input.value);
                    
                    if (this.classList.contains('minus') && value > 0) {
                        input.value = value - 1;
                    } else if (this.classList.contains('plus')) {
                        input.value = value + 1;
                    }
                });
            });

            // Soumission du formulaire avec table spécifique
            document.getElementById('tableReservationForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!document.getElementById('selected-table').value) {
                    alert('Veuillez sélectionner une table');
                    return;
                }
                
                submitReservation(this);
            });

            // Soumission du formulaire général
            document.getElementById('generalReservationForm').addEventListener('submit', function(e) {
                e.preventDefault();
                submitReservation(this);
            });

            // Fonction de soumission commune
            function submitReservation(form) {
                // Validation des informations client
                const clientName = document.getElementById('client-name').value;
                const clientEmail = document.getElementById('client-email').value;
                const clientPhone = document.getElementById('client-phone').value;
                
                if (!clientName || !clientEmail || !clientPhone) {
                    alert('Veuillez remplir toutes les informations personnelles');
                    return;
                }
                
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement...';
                submitBtn.disabled = true;
                
                // Récupérer les pré-commandes
                let precommandes = {};
                if (form.id === 'tableReservationForm') {
                    precommandes = {
                        entreeCesar: parseInt(document.getElementById('entree-cesar').value),
                        platBoeuf: parseInt(document.getElementById('plat-boeuf').value),
                        dessertChocolat: parseInt(document.getElementById('dessert-chocolat').value),
                        boissonVin: parseInt(document.getElementById('boisson-vin').value)
                    };
                } else {
                    precommandes = {
                        entreeCesar: parseInt(document.getElementById('entree-cesar-general').value),
                        platBoeuf: parseInt(document.getElementById('plat-boeuf-general').value),
                        dessertChocolat: parseInt(document.getElementById('dessert-chocolat-general').value),
                        boissonVin: parseInt(document.getElementById('boisson-vin-general').value)
                    };
                }
                
                // Simulation d'envoi au serveur
                setTimeout(() => {
                    alert('Réservation confirmée ! Un email de confirmation vous a été envoyé.');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    
                    // Redirection après 2 secondes
                    setTimeout(() => {
                        window.location.href = 'reservation-confirmation.html';
                    }, 2000);
                }, 1500);
            }

            // Définir la date minimale (aujourd'hui)
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('table-date').min = today;
            document.getElementById('general-date').min = today;
            
            // Mettre à jour les tables disponibles en fonction du nombre de personnes
            document.getElementById('table-capacity').addEventListener('change', function() {
                const capacity = parseInt(this.value);
                const tables = document.querySelectorAll('.table-card:not(.unavailable)');
                
                tables.forEach(table => {
                    const tableCapacity = parseInt(table.getAttribute('data-capacity'));
                    if (capacity > tableCapacity) {
                        table.classList.add('unavailable');
                        table.classList.remove('selected');
                        table.querySelector('.table-status').textContent = 'Trop petit';
                    } else {
                        table.classList.remove('unavailable');
                        table.querySelector('.table-status').textContent = 'Disponible';
                    }
                });
            });
        });
    </script>
</body>
</html>