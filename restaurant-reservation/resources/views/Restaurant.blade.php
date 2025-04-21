<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil du Restaurant | RestoReserve</title>
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

        /* Main Content - Centré et Agrandi */
        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 3rem;
            max-width: var(--max-width);
            margin: 0 auto;
            width: 100%;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            color: var(--primary);
            text-decoration: none;
            margin-bottom: 2.5rem;
            font-weight: 600;
            padding: 1rem 2rem;
            border-radius: var(--radius);
            background-color: var(--primary-light);
            transition: var(--transition);
            align-self: flex-start;
            font-size: 1.2rem;
        }

        .back-button:hover {
            background-color: rgba(222, 116, 9, 0.2);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(222, 116, 9, 0.2);
        }

        /* Profile Header - Agrandi et Centré */
        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin-bottom: 4rem;
            position: relative;
        }

        .banner-image {
            height: 350px;
            width: 100%;
            max-width: 1200px;
            background-size: cover;
            background-position: center;
            border-radius: var(--radius);
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .banner-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(4,19,74,0.4));
        }

        .profile-main {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 1200px;
        }

        .restaurant-logo {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid white;
            box-shadow: var(--shadow);
            margin-top: -100px;
            z-index: 2;
            background-color: white;
        }

        .profile-info {
            width: 100%;
            background: white;
            padding: 3.5rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border-top: 6px solid var(--primary);
            text-align: center;
        }

        .profile-title {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 1rem;
            gap: 1.5rem;
        }

        h1 {
            margin: 0;
            color: var(--secondary);
            font-size: 2.8rem;
            font-weight: 700;
            text-align: center;
            line-height: 1.2;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 1rem;
            background-color: rgba(255, 193, 7, 0.2);
            padding: 0.8rem 2rem;
            border-radius: 30px;
            color: var(--warning);
            font-weight: 600;
            font-size: 1.4rem;
        }

        .cuisine-type {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 2rem;
            display: inline-block;
            padding: 0.8rem 2rem;
            background-color: var(--primary-light);
            border-radius: 30px;
            font-size: 1.3rem;
        }

        .meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin: 2.5rem 0;
            justify-content: center;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            color: var(--gray);
            font-size: 1.3rem;
            background: var(--light);
            padding: 1rem 1.5rem;
            border-radius: var(--radius);
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .meta-icon {
            color: var(--primary);
            font-size: 1.4rem;
        }

        .description {
            margin: 3rem auto;
            line-height: 1.8;
            color: var(--gray);
            font-size: 1.25rem;
            max-width: 900px;
            text-align: center;
        }

        .badges-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1.2rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 600;
            gap: 0.8rem;
        }

        .badge-primary {
            background-color: var(--primary-light);
            color: var(--primary);
            box-shadow: 0 3px 10px rgba(222, 116, 9, 0.1);
        }

        /* Gallery Section - Agrandie */
        .gallery {
            margin: 4rem 0;
            background: white;
            padding: var(--section-padding);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 1200px;
            border-top: 6px solid var(--secondary);
        }

        .section-title {
            font-size: 2.2rem;
            color: var(--secondary);
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 4px solid var(--secondary-light);
            text-align: center;
        }

        .section-title i {
            color: var(--primary);
            font-size: 1.8rem;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            justify-items: center;
        }

        .gallery-item {
            height: 220px;
            width: 100%;
            max-width: 300px;
            background-size: cover;
            background-position: center;
            border-radius: var(--radius);
            transition: var(--transition);
            cursor: pointer;
            box-shadow: var(--shadow);
        }

        .gallery-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        /* Menu Section - Agrandie */
        .menu-section {
            margin: 4rem 0;
            background: white;
            padding: var(--section-padding);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 1200px;
            border-top: 6px solid var(--primary);
        }

        .menu-categories {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 3rem;
            justify-items: center;
        }

        .menu-category {
            background: var(--light);
            padding: 2.5rem;
            border-radius: var(--radius);
            transition: var(--transition);
            border-left: 6px solid var(--primary);
            width: 100%;
            max-width: 400px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .menu-category:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .category-title {
            color: var(--secondary);
            margin-top: 0;
            margin-bottom: 2rem;
            font-size: 1.6rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.2rem;
            text-align: center;
        }

        .category-title i {
            color: var(--primary);
            font-size: 1.5rem;
        }

        .menu-item {
            margin-bottom: 2rem;
            position: relative;
            padding: 1.5rem;
            background: white;
            border-radius: var(--radius);
            transition: var(--transition);
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            text-align: left;
        }

        .menu-item:hover {
            transform: translateX(8px);
        }

        .menu-item.promotion {
            border-left: 4px solid var(--primary);
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            align-items: center;
        }

        .item-name {
            font-weight: 600;
            margin: 0;
            color: var(--secondary);
            display: flex;
            align-items: center;
            font-size: 1.3rem;
        }

        .promo-badge {
            background-color: var(--primary);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: bold;
            margin-left: 1rem;
        }

        .price-comparison {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .original-price {
            text-decoration: line-through;
            color: var(--gray);
            font-size: 1.1rem;
        }

        .item-price {
            color: var(--primary);
            font-weight: bold;
            font-size: 1.4rem;
        }

        .economy-tag {
            background-color: var(--warning);
            color: var(--dark);
            padding: 0.4rem 0.8rem;
            border-radius: 5px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .item-description {
            color: var(--gray);
            font-size: 1.1rem;
            margin: 0;
            line-height: 1.7;
        }

        /* Reservation Section - Agrandie */
        .reservation-section {
            background: white;
            padding: var(--section-padding);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin: 4rem 0;
            width: 100%;
            max-width: 1200px;
            border-top: 6px solid var(--secondary);
        }

        .reservation-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        label {
            display: block;
            margin-bottom: 1rem;
            font-weight: 600;
            color: var(--secondary);
            font-size: 1.3rem;
        }

        input, select, textarea {
            width: 100%;
            padding: 1.2rem;
            border: 2px solid #ddd;
            border-radius: var(--radius);
            font-size: 1.1rem;
            transition: var(--transition);
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 4px rgba(222, 116, 9, 0.2);
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 1.5rem 3rem;
            font-size: 1.3rem;
            font-weight: 600;
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            margin-top: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 1.2rem;
            box-shadow: 0 8px 20px rgba(222, 116, 9, 0.3);
            width: 100%;
            max-width: 350px;
            margin: 3rem auto 0;
        }

        .submit-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(222, 116, 9, 0.4);
        }

        /* Footer Agrandi */
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
            
            .navbar {
                flex-direction: column;
                gap: 2rem;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        @media (max-width: 992px) {
            :root {
                --section-padding: 3rem;
            }
            
            .main-container {
                padding: 2.5rem;
            }

            .banner-image {
                height: 300px;
            }

            .restaurant-logo {
                width: 180px;
                height: 180px;
                margin-top: -90px;
            }

            h1 {
                font-size: 2.4rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .menu-categories {
                grid-template-columns: 1fr;
            }

            .menu-category {
                max-width: 100%;
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
            
            .main-container {
                padding: 2rem;
            }

            .banner-image {
                height: 250px;
            }

            .restaurant-logo {
                width: 150px;
                height: 150px;
                margin-top: -75px;
            }

            .profile-info, .gallery, .menu-section, .reservation-section {
                padding: 2.5rem;
            }

            h1 {
                font-size: 2.2rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .meta-item {
                font-size: 1.1rem;
                padding: 0.8rem 1.2rem;
            }

            .description {
                font-size: 1.1rem;
            }

            .reservation-form {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            :root {
                --section-padding: 2rem;
            }
            
            .main-container {
                padding: 1.5rem;
            }

            .back-button {
                font-size: 1.1rem;
                padding: 0.8rem 1.5rem;
            }

            .banner-image {
                height: 200px;
                border-radius: 12px;
            }

            .restaurant-logo {
                width: 120px;
                height: 120px;
                margin-top: -60px;
                border-width: 4px;
            }

            .profile-info, .gallery, .menu-section, .reservation-section {
                padding: 2rem 1.5rem;
                border-radius: 14px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.6rem;
                flex-direction: column;
                gap: 1rem;
            }

            .rating, .cuisine-type {
                font-size: 1.1rem;
                padding: 0.6rem 1.5rem;
            }

            .meta-info {
                flex-direction: column;
                align-items: center;
                gap: 1.2rem;
            }

            .meta-item {
                width: 100%;
                justify-content: center;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .gallery-item {
                height: 200px;
                max-width: 100%;
            }

            .submit-btn {
                font-size: 1.1rem;
                padding: 1.2rem 2rem;
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
                <a href="#"><i class="fas fa-home"></i> Accueil</a>
                <a href="#" class="active"><i class="fas fa-search"></i> Restaurants</a>
                <a href="#"><i class="fas fa-calendar-alt"></i> Réservations</a>
                <a href="#"><i class="fas fa-user"></i> Mon compte</a>
                <a href="#"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            </div>
        </div>
    </header>

    <div class="main-container">
        <a href="#" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Retour aux restaurants
        </a>
        
        <div class="profile-header">
            <div class="banner-image" style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
            <div class="profile-main">
                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Le Gourmet Parisien" class="restaurant-logo">
                <div class="profile-info">
                    <div class="profile-title">
                        <h1>Le Gourmet Parisien</h1>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            4.2 (128 avis)
                        </div>
                    </div>
                    <div class="cuisine-type">Cuisine française • $$$</div>
                    
                    <div class="meta-info">
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt meta-icon"></i>
                            <span>12 Rue de la Paix, 75002 Paris</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-phone meta-icon"></i>
                            <span>01 23 45 67 89</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-envelope meta-icon"></i>
                            <span>contact@gourmetparisien.com</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clock meta-icon"></i>
                            <span>12h-14h30, 19h-22h30 (Fermé le lundi)</span>
                        </div>
                    </div>
                    
                    <div class="description">
                        <p>Le Gourmet Parisien est un restaurant gastronomique situé en plein cœur de Paris. Notre chef étoilé, Jean-Luc Dubois, propose une cuisine française moderne mettant en valeur les produits locaux et de saison. Dans un cadre élégant et raffiné, nous vous invitons à découvrir une expérience culinaire exceptionnelle.</p>
                        <p>Notre restaurant dispose d'une cave à vin réputée avec plus de 500 références soigneusement sélectionnées pour accompagner vos plats. Nous accueillons également les événements privés dans notre salon VIP pouvant recevoir jusqu'à 30 personnes.</p>
                    </div>
                    
                    <div class="badges-container">
                        <span class="badge badge-primary"><i class="fas fa-umbrella-beach"></i> Terrasse</span>
                        <span class="badge badge-primary"><i class="fas fa-wifi"></i> Wifi gratuit</span>
                        <span class="badge badge-primary"><i class="fas fa-wheelchair"></i> Accès PMR</span>
                        <span class="badge badge-primary"><i class="fas fa-wine-bottle"></i> Cave à vin</span>
                        <span class="badge badge-primary"><i class="fas fa-snowflake"></i> Climatisé</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="gallery">
            <h2 class="section-title">
                <i class="fas fa-images"></i>
                Galerie
            </h2>
            <div class="gallery-grid">
                <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80');"></div>
                <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80');"></div>
                <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1544025162-d76694265947?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80');"></div>
                <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80');"></div>
            </div>
        </div>
        
        <div class="menu-section">
            <h2 class="section-title">
                <i class="fas fa-utensils"></i>
                Notre Menu
            </h2>
            <div class="menu-categories">
                <div class="menu-category">
                    <h3 class="category-title">
                        <i class="fas fa-bread-slice"></i>
                        Entrées
                    </h3>
                    
                    <!-- Item avec promotion -->
                    <div class="menu-item promotion">
                        <div class="item-header">
                            <h4 class="item-name"><strong>Foie gras mi-cuit</strong> <span class="promo-badge">PROMO</span></h4>
                            <div class="price-comparison">
                                <span class="original-price">35€</span>
                                <span class="item-price">28€</span>
                                <span class="economy-tag">-20%</span>
                            </div>
                        </div>
                        <p class="item-description">Chutney de figues, pain d'épices toasté</p>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-header">
                            <h4 class="item-name"><strong>Velouté de champignons</strong></h4>
                            <span class="item-price">18€</span>
                        </div>
                        <p class="item-description">Champignons des bois, crème fraîche</p>
                    </div>
                </div>
                
                <div class="menu-category">
                    <h3 class="category-title">
                        <i class="fas fa-drumstick-bite"></i>
                        Plats Principaux
                    </h3>
                    
                    <!-- Item avec promotion -->
                    <div class="menu-item promotion">
                        <div class="item-header">
                            <h4 class="item-name"><strong>Menu Découverte</strong> <span class="promo-badge">SPÉCIAL</span></h4>
                            <div class="price-comparison">
                                <span class="original-price">75€</span>
                                <span class="item-price">60€</span>
                                <span class="economy-tag">Économisez 15€</span>
                            </div>
                        </div>
                        <p class="item-description">Entrée + Plat + Dessert + Vin de la maison</p>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-header">
                            <h4 class="item-name"><strong>Magret de canard</strong></h4>
                            <span class="item-price">36€</span>
                        </div>
                        <p class="item-description">Sauce aux cerises, gratin dauphinois</p>
                    </div>
                </div>
                
                <div class="menu-category">
                    <h3 class="category-title">
                        <i class="fas fa-ice-cream"></i>
                        Desserts
                    </h3>
                    
                    <!-- Item avec promotion -->
                    <div class="menu-item promotion">
                        <div class="item-header">
                            <h4 class="item-name"><strong>Assiette gourmande</strong> <span class="promo-badge">2+1 OFFERT</span></h4>
                            <div class="price-comparison">
                                <span class="original-price">42€</span>
                                <span class="item-price">28€</span>
                                <span class="economy-tag">3 pour le prix de 2</span>
                            </div>
                        </div>
                        <p class="item-description">Sélection de 3 desserts de votre choix</p>
                    </div>
                    
                    <div class="menu-item">
                        <div class="item-header">
                            <h4 class="item-name"><strong>Tarte fine aux pommes</strong></h4>
                            <span class="item-price">14€</span>
                        </div>
                        <p class="item-description">Crème anglaise, caramel beurre salé</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="reservation-section">
            <h2 class="section-title">
                <i class="fas fa-calendar-check"></i>
                Réserver une table
            </h2>
            <form class="reservation-form">
                <div class="form-group">
                    <label for="name">Nom complet</label>
                    <input type="text" id="name" required placeholder="Votre nom">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" required placeholder="Votre email">
                </div>
                <div class="form-group">
                    <label for="phone">Téléphone</label>
                    <input type="tel" id="phone" required placeholder="Votre numéro">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" required>
                </div>
                <div class="form-group">
                    <label for="time">Heure</label>
                    <input type="time" id="time" required>
                </div>
                <div class="form-group">
                    <label for="guests">Nombre de personnes</label>
                    <select id="guests" required>
                        <option value="" disabled selected>Sélectionnez</option>
                        <option value="1">1 personne</option>
                        <option value="2">2 personnes</option>
                        <option value="3">3 personnes</option>
                        <option value="4">4 personnes</option>
                        <option value="5">5 personnes</option>
                        <option value="6+">6+ personnes</option>
                    </select>
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="notes">Demandes spéciales</label>
                    <textarea id="notes" placeholder="Allergies, anniversaire, etc."></textarea>
                </div>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-check-circle"></i>
                    Confirmer la réservation
                </button>
            </form>
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
        // Animation au chargement de la page
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('.gallery-item, .menu-category, .form-group');
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