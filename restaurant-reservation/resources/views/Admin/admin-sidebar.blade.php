<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - RestoReserve')</title>
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
            --warning: #ffc107;
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
            background-color: #f5f5f5;
            color: var(--dark);
            line-height: 1.7;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: var(--secondary);
            color: white;
            padding: 2rem 0;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0 2rem;
            margin-bottom: 2.5rem;
        }

        .logo i {
            font-size: 2rem;
            color: var(--primary);
        }

        .logo h1 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 2rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: var(--transition);
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(222, 116, 9, 0.2);
            color: white;
            border-left: 4px solid var(--primary);
        }

        .nav-link i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.8rem;
            color: var(--secondary);
        }

        .page-title i {
            color: var(--primary);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            background: white;
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--secondary);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .card-icon.primary {
            background-color: rgba(222, 116, 9, 0.1);
            color: var(--primary);
        }

        .card-icon.success {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }

        .card-icon.warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }

        .card-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-footer {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--gray);
        }

        /* Admin Sections */
        .admin-section {
            background: white;
            border-radius: var(--radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 1.4rem;
            color: var(--secondary);
        }

        .section-title i {
            color: var(--primary);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: var(--radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(222, 116, 9, 0.3);
        }

        .btn-secondary {
            background-color: white;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-secondary:hover {
            background-color: var(--primary);
            color: white;
        }

        /* Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .data-table th, .data-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .data-table th {
            background-color: var(--secondary);
            color: white;
            font-weight: 600;
        }

        .data-table tr:hover {
            background-color: rgba(222, 116, 9, 0.05);
        }

        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-success {
            background-color: rgba(40, 167, 69, 0.2);
            color: var(--success);
        }

        .badge-warning {
            background-color: rgba(255, 193, 7, 0.2);
            color: var(--warning);
        }

        .badge-danger {
            background-color: rgba(220, 53, 69, 0.2);
            color: var(--danger);
        }

        .badge-primary {
            background-color: rgba(222, 116, 9, 0.2);
            color: var(--primary-dark);
        }

        .table-actions {
            display: flex;
            gap: 0.5rem;
        }

        .table-btn {
            border: none;
            background: none;
            cursor: pointer;
            font-size: 1.1rem;
            transition: var(--transition);
            color: var(--gray);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .table-btn:hover {
            background-color: rgba(222, 116, 9, 0.1);
            color: var(--primary);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            border-radius: var(--radius);
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2rem;
            position: relative;
            box-shadow: var(--shadow);
        }

        .close {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray);
            transition: var(--transition);
        }

        .close:hover {
            color: var(--dark);
        }

        .modal-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .modal-title i {
            color: var(--primary);
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

        /* Responsive */
        @media (max-width: 1200px) {
            .sidebar {
                width: 250px;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                padding: 1rem 0;
            }
            
            .logo h1, .nav-link span {
                display: none;
            }
            
            .logo {
                justify-content: center;
                padding: 0 0.5rem;
            }
            
            .nav-link {
                justify-content: center;
                padding: 1rem 0.5rem;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }

            .main-content {
                padding: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
                width: 100%;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .message-content {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-utensils"></i>
            <h1>RestoReserve</h1>
        </div>
        
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Restaurant.index') }}" class="nav-link">
                    <i class="fas fa-store"></i>
                    <span>Restaurants</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('menu-categorie.index') }}" class="nav-link">
                    <i class="fas fa-layer-group"></i>
                    <span>Catégories</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('plats.index') }}" class="nav-link">
                    <i class="fas fa-utensils"></i>
                    <span>Plats</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('horaires.index') }}" class="nav-link">
                    <i class="fas fa-clock"></i>
                    <span>Horaires</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('tables.index') }}" class="nav-link">
                    <i class="fas fa-chair"></i>
                    <span>Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('commandes.index') }}" class="nav-link">
                    <i class="fas fa-receipt"></i>
                    <span>Commandes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('paiements.index') }}" class="nav-link">
                    <i class="fas fa-credit-card"></i>
                    <span>Paiements</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('livraisons.index') }}" class="nav-link">
                    <i class="fas fa-truck"></i>
                    <span>Livraisons</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('livreurs.index') }}" class="nav-link">
                    <i class="fas fa-user-tie"></i>
                    <span>Livreurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('messagerie.index') }}" class="nav-link">
                    <i class="fas fa-comments"></i>
                    <span>Messagerie</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('parametres.index') }}" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mise à jour des modals et boutons
            const modals = {
                category: document.getElementById('category-modal'),
                plat: document.getElementById('plat-modal'),
                exception: document.getElementById('exception-modal'),
                restaurant: document.getElementById('restaurant-modal') // Ajouté
            };
            
            const openButtons = {
                category: document.getElementById('add-category'),
                plat: document.getElementById('add-plat'),
                exception: document.getElementById('add-exception'),
                restaurant: document.getElementById('add-restaurant') // Ajouté
            };
            
            // Le reste du JavaScript reste identique
            const closeButtons = document.querySelectorAll('.close');
            
            // Ouvrir les modals
            Object.keys(openButtons).forEach(key => {
                if (openButtons[key]) {
                    openButtons[key].addEventListener('click', () => {
                        modals[key].style.display = 'flex';
                    });
                }
            });
            
            // Fermer les modals
            closeButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    this.closest('.modal').style.display = 'none';
                });
            });
            
            // Fermer en cliquant à l'extérieur
            window.addEventListener('click', function(event) {
                if (event.target.classList.contains('modal')) {
                    event.target.style.display = 'none';
                }
            });
            
            // Gestion du type d'exception
            const exceptionType = document.getElementById('exception-type');
            const exceptionHours = document.getElementById('exception-hours');
            
            if (exceptionType) {
                exceptionType.addEventListener('change', function() {
                    exceptionHours.style.display = this.value === 'special' ? 'block' : 'none';
                });
            }
            
            // Prévisualisation de l'image du plat
            const platImage = document.getElementById('plat-image');
            const platImagePreview = document.getElementById('plat-image-preview');
            
            if (platImage && platImagePreview) {
                platImage.addEventListener('change', function(e) {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            platImagePreview.src = e.target.result;
                            platImagePreview.style.display = 'block';
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }
            
            // Navigation dans le sidebar
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Retirer la classe active de tous les liens
                    navLinks.forEach(l => l.classList.remove('active'));
                    
                    // Ajouter la classe active au lien cliqué
                    this.classList.add('active');
                    
                    // Faire défiler jusqu'à la section correspondante
                    const targetId = this.getAttribute('href');
                    if (targetId && targetId !== '#') {
                        document.querySelector(targetId).scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Gestion du chat
            const chatContacts = document.querySelectorAll('.chat-contact');
            const messageInput = document.getElementById('message-text');
            const sendButton = document.getElementById('send-message');
            const chatMessages = document.querySelector('.chat-messages');

            // Sélectionner un contact
            chatContacts.forEach(contact => {
                contact.addEventListener('click', function() {
                    chatContacts.forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Mettre à jour l'en-tête du chat
                    const contactName = this.querySelector('.chat-contact-name').textContent;
                    document.querySelector('.chat-header').textContent = `Conversation avec ${contactName}`;
                    
                    // Ici, vous pourriez charger les messages depuis une API
                });
            });

            // Envoyer un message
            function sendMessage() {
                const messageText = messageInput.value.trim();
                if (messageText) {
                    // Créer un nouveau message envoyé
                    const messageElement = document.createElement('div');
                    messageElement.className = 'message sent';
                    messageElement.innerHTML = `
                        <div class="message-content">${messageText}</div>
                        <div class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                    `;
                    
                    chatMessages.appendChild(messageElement);
                    messageInput.value = '';
                    
                    // Faire défiler vers le bas
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                    
                    // Simuler une réponse après un délai
                    setTimeout(() => {
                        const replyElement = document.createElement('div');
                        replyElement.className = 'message received';
                        replyElement.innerHTML = `
                            <div class="message-content">Merci pour votre message. Nous traitons votre demande.</div>
                            <div class="message-time">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</div>
                        `;
                        chatMessages.appendChild(replyElement);
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }, 1000);
                }
            }

            // Envoyer avec le bouton
            sendButton.addEventListener('click', sendMessage);
            
            // Envoyer avec Entrée
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        });
    </script>