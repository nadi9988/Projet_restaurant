<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - RestoReserve</title>
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

        /* Calendar for Horaires */
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .calendar-header {
            background-color: var(--secondary);
            color: white;
            padding: 0.8rem;
            text-align: center;
            font-weight: 600;
            border-radius: var(--radius);
        }

        .calendar-day {
            background-color: white;
            border: 1px solid #e0e0e0;
            padding: 0.8rem;
            min-height: 100px;
            border-radius: var(--radius);
        }

        .day-number {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .time-input {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .time-input input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
        }

        /* Chat Styles */
        .chat-container {
            display: flex;
            height: 600px;
            border: 1px solid #e0e0e0;
            border-radius: var(--radius);
            overflow: hidden;
        }

        .chat-sidebar {
            width: 300px;
            background-color: #f8f9fa;
            border-right: 1px solid #e0e0e0;
            overflow-y: auto;
        }

        .chat-main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            padding: 1rem;
            background-color: var(--secondary);
            color: white;
            font-weight: 600;
        }

        .chat-messages {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
            background-color: white;
        }

        .chat-input {
            padding: 1rem;
            background-color: #f8f9fa;
            border-top: 1px solid #e0e0e0;
        }

        .message-input {
            display: flex;
            gap: 0.5rem;
        }

        .message-input input {
            flex: 1;
            padding: 0.8rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: var(--radius);
        }

        .message-input button {
            padding: 0 1.5rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
        }

        .message-input button:hover {
            background-color: var(--primary-dark);
        }

        .chat-contact {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #e0e0e0;
            cursor: pointer;
            transition: var(--transition);
        }

        .chat-contact:hover {
            background-color: rgba(222, 116, 9, 0.1);
        }

        .chat-contact.active {
            background-color: rgba(222, 116, 9, 0.2);
        }

        .chat-contact-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 1rem;
        }

        .chat-contact-info {
            flex: 1;
        }

        .chat-contact-name {
            font-weight: 600;
        }

        .chat-contact-last {
            font-size: 0.8rem;
            color: var(--gray);
        }

        .chat-contact-time {
            font-size: 0.7rem;
            color: var(--gray);
        }

        .message {
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
        }

        .message.received {
            align-items: flex-start;
        }

        .message.sent {
            align-items: flex-end;
        }

        .message-content {
            max-width: 70%;
            padding: 0.8rem 1rem;
            border-radius: var(--radius);
            margin-bottom: 0.3rem;
        }

        .message.received .message-content {
            background-color: #f0f0f0;
            border-top-left-radius: 4px;
        }

        .message.sent .message-content {
            background-color: var(--primary);
            color: white;
            border-top-right-radius: 4px;
        }

        .message-time {
            font-size: 0.7rem;
            color: var(--gray);
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

            .chat-container {
                flex-direction: column;
                height: auto;
            }

            .chat-sidebar {
                width: 100%;
                max-height: 200px;
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 1rem;
            }
            
            .logo h1 {
                display: block;
                font-size: 1.2rem;
            }
            
            .nav-menu {
                display: flex;
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }
            
            .nav-item {
                margin-bottom: 0;
                flex-shrink: 0;
            }
            
            .nav-link span {
                display: block;
                font-size: 0.9rem;
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
                <a href="#" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#menu-categories" class="nav-link">
                    <i class="fas fa-list"></i>
                    <span>Catégories</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#plats" class="nav-link">
                    <i class="fas fa-utensils"></i>
                    <span>Plats</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#horaires" class="nav-link">
                    <i class="fas fa-clock"></i>
                    <span>Horaires</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#tables" class="nav-link">
                    <i class="fas fa-chair"></i>
                    <span>Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#commandes" class="nav-link">
                    <i class="fas fa-receipt"></i>
                    <span>Commandes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#paiements" class="nav-link">
                    <i class="fas fa-credit-card"></i>
                    <span>Paiements</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#livraisons" class="nav-link">
                    <i class="fas fa-truck"></i>
                    <span>Livraisons</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#livreurs" class="nav-link">
                    <i class="fas fa-user-tie"></i>
                    <span>Livreurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#messagerie" class="nav-link">
                    <i class="fas fa-comments"></i>
                    <span>Messagerie</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#parametres" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1 class="page-title">
                <i class="fas fa-tachometer-alt"></i>
                Tableau de bord
            </h1>
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <span>Admin</span>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-cards">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Commandes aujourd'hui</h3>
                    <div class="card-icon primary">
                        <i class="fas fa-receipt"></i>
                    </div>
                </div>
                <div class="card-value">24</div>
                <div class="card-footer">
                    <i class="fas fa-arrow-up text-success"></i>
                    <span>12% vs hier</span>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Réservations</h3>
                    <div class="card-icon success">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
                <div class="card-value">18</div>
                <div class="card-footer">
                    <i class="fas fa-arrow-up text-success"></i>
                    <span>5% vs hier</span>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chiffre d'affaires</h3>
                    <div class="card-icon warning">
                        <i class="fas fa-euro-sign"></i>
                    </div>
                </div>
                <div class="card-value">1,245€</div>
                <div class="card-footer">
                    <i class="fas fa-arrow-up text-success"></i>
                    <span>8% vs hier</span>
                </div>
            </div>
        </div>

        <!-- Menu Categories Section -->
        <div id="menu-categories" class="admin-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-list"></i>
                    Catégories de menu
                </h2>
                <div class="action-buttons">
                    <button class="btn btn-primary" id="add-category">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Plats associés</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Entrées</td>
                        <td>Nos délicieuses entrées maison</td>
                        <td><span class="badge badge-primary">5 plats</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Plats principaux</td>
                        <td>Les spécialités du chef</td>
                        <td><span class="badge badge-primary">8 plats</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Desserts</td>
                        <td>Pour terminer en douceur</td>
                        <td><span class="badge badge-primary">4 plats</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Messagerie Section -->
        <div id="messagerie" class="admin-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-comments"></i>
                    Messagerie
                </h2>
                <div class="action-buttons">
                    <button class="btn btn-secondary">
                        <i class="fas fa-filter"></i> Filtrer
                    </button>
                </div>
            </div>
            
            <div class="chat-container">
                <div class="chat-sidebar">
                    <div class="chat-contact active">
                        <div class="chat-contact-avatar">JD</div>
                        <div class="chat-contact-info">
                            <div class="chat-contact-name">Jean Dupont</div>
                            <div class="chat-contact-last">Dernier message...</div>
                        </div>
                        <div class="chat-contact-time">12:30</div>
                    </div>
                    <div class="chat-contact">
                        <div class="chat-contact-avatar">ML</div>
                        <div class="chat-contact-info">
                            <div class="chat-contact-name">Marie Lambert</div>
                            <div class="chat-contact-last">Question sur ma commande</div>
                        </div>
                        <div class="chat-contact-time">11:45</div>
                    </div>
                    <div class="chat-contact">
                        <div class="chat-contact-avatar">PM</div>
                        <div class="chat-contact-info">
                            <div class="chat-contact-name">Paul Martin</div>
                            <div class="chat-contact-last">Réservation pour 4 personnes</div>
                        </div>
                        <div class="chat-contact-time">Hier</div>
                    </div>
                    <div class="chat-contact">
                        <div class="chat-contact-avatar">SB</div>
                        <div class="chat-contact-info">
                            <div class="chat-contact-name">Sophie Bernard</div>
                            <div class="chat-contact-last">Merci pour votre aide!</div>
                        </div>
                        <div class="chat-contact-time">Lun</div>
                    </div>
                </div>
                <div class="chat-main">
                    <div class="chat-header">
                        Conversation avec Jean Dupont
                    </div>
                    <div class="chat-messages">
                        <div class="message received">
                            <div class="message-content">
                                Bonjour, j'ai une question concernant ma réservation de ce soir.
                            </div>
                            <div class="message-time">12:05</div>
                        </div>
                        <div class="message sent">
                            <div class="message-content">
                                Bonjour Jean, comment puis-je vous aider ?
                            </div>
                            <div class="message-time">12:10</div>
                        </div>
                        <div class="message received">
                            <div class="message-content">
                                Je voudrais savoir si je peux changer l'heure de ma réservation de 20h à 19h30 ?
                            </div>
                            <div class="message-time">12:12</div>
                        </div>
                        <div class="message sent">
                            <div class="message-content">
                                Je vérifie la disponibilité et je vous réponds dans quelques instants.
                            </div>
                            <div class="message-time">12:15</div>
                        </div>
                        <div class="message sent">
                            <div class="message-content">
                                C'est possible, j'ai modifié votre réservation pour 19h30. Vous recevrez une confirmation par email.
                            </div>
                            <div class="message-time">12:20</div>
                        </div>
                        <div class="message received">
                            <div class="message-content">
                                Parfait, merci beaucoup !
                            </div>
                            <div class="message-time">12:22</div>
                        </div>
                    </div>
                    <div class="chat-input">
                        <div class="message-input">
                            <input type="text" placeholder="Tapez votre message..." id="message-text">
                            <button id="send-message"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plats Section -->
        <div id="plats" class="admin-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-utensils"></i>
                    Gestion des plats
                </h2>
                <div class="action-buttons">
                    <button class="btn btn-primary" id="add-plat">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><img src="https://via.placeholder.com/50" alt="Salade César" style="width:50px;border-radius:4px;"></td>
                        <td>Salade César</td>
                        <td>Entrées</td>
                        <td>12€</td>
                        <td><span class="badge badge-success">Disponible</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><img src="https://via.placeholder.com/50" alt="Filet de boeuf" style="width:50px;border-radius:4px;"></td>
                        <td>Filet de boeuf</td>
                        <td>Plats principaux</td>
                        <td>28€</td>
                        <td><span class="badge badge-success">Disponible</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><img src="https://via.placeholder.com/50" alt="Fondant au chocolat" style="width:50px;border-radius:4px;"></td>
                        <td>Fondant au chocolat</td>
                        <td>Desserts</td>
                        <td>9€</td>
                        <td><span class="badge badge-danger">Indisponible</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Horaires Section -->
        <div id="horaires" class="admin-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-clock"></i>
                    Gestion des horaires
                </h2>
                <div class="action-buttons">
                    <button class="btn btn-primary" id="add-exception">
                        <i class="fas fa-plus"></i> Ajouter exception
                    </button>
                </div>
            </div>
            
            <div class="calendar">
                <div class="calendar-header">Lundi</div>
                <div class="calendar-header">Mardi</div>
                <div class="calendar-header">Mercredi</div>
                <div class="calendar-header">Jeudi</div>
                <div class="calendar-header">Vendredi</div>
                <div class="calendar-header">Samedi</div>
                <div class="calendar-header">Dimanche</div>
                
                <div class="calendar-day">
                    <div class="day-number">1</div>
                    <div class="time-input">
                        <input type="time" value="11:30">
                        <span>-</span>
                        <input type="time" value="14:30">
                    </div>
                    <div class="time-input">
                        <input type="time" value="19:00">
                        <span>-</span>
                        <input type="time" value="22:00">
                    </div>
                </div>
                
                <div class="calendar-day">
                    <div class="day-number">2</div>
                    <div class="time-input">
                        <input type="time" value="11:30">
                        <span>-</span>
                        <input type="time" value="14:30">
                    </div>
                    <div class="time-input">
                        <input type="time" value="19:00">
                        <span>-</span>
                        <input type="time" value="22:00">
                    </div>
                </div>
                
                <div class="calendar-day">
                    <div class="day-number">3</div>
                    <div class="time-input">
                        <input type="time" value="11:30">
                        <span>-</span>
                        <input type="time" value="14:30">
                    </div>
                    <div class="time-input">
                        <input type="time" value="19:00">
                        <span>-</span>
                        <input type="time" value="22:00">
                    </div>
                </div>
                
                <div class="calendar-day">
                    <div class="day-number">4</div>
                    <div class="time-input">
                        <input type="time" value="11:30">
                        <span>-</span>
                        <input type="time" value="14:30">
                    </div>
                    <div class="time-input">
                        <input type="time" value="19:00">
                        <span>-</span>
                        <input type="time" value="22:00">
                    </div>
                </div>
                
                <div class="calendar-day">
                    <div class="day-number">5</div>
                    <div class="time-input">
                        <input type="time" value="11:30">
                        <span>-</span>
                        <input type="time" value="14:30">
                    </div>
                    <div class="time-input">
                        <input type="time" value="19:00">
                        <span>-</span>
                        <input type="time" value="22:00">
                    </div>
                </div>
                
                <div class="calendar-day">
                    <div class="day-number">6</div>
                    <div class="time-input">
                        <input type="time" value="11:30">
                        <span>-</span>
                        <input type="time" value="15:00">
                    </div>
                    <div class="time-input">
                        <input type="time" value="19:00">
                        <span>-</span>
                        <input type="time" value="23:00">
                    </div>
                </div>
                
                <div class="calendar-day">
                    <div class="day-number">7</div>
                    <div class="time-input">
                        <input type="time" value="11:30">
                        <span>-</span>
                        <input type="time" value="15:00">
                    </div>
                    <div class="time-input">
                        <input type="time" value="19:00">
                        <span>-</span>
                        <input type="time" value="23:00">
                    </div>
                </div>
            </div>
            
            <h3 style="margin-top: 2rem;">Jours exceptionnels</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Horaires</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>25/12/2023</td>
                        <td><span class="badge badge-danger">Fermé</span></td>
                        <td>-</td>
                        <td>Jour de Noël</td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>01/01/2024</td>
                        <td><span class="badge badge-warning">Horaires spéciaux</span></td>
                        <td>12:00 - 16:00</td>
                        <td>Nouvel An</td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tables Section -->
        <div id="tables" class="admin-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-chair"></i>
                    Gestion des tables
                </h2>
                <div class="action-buttons">
                    <button class="btn btn-primary" id="add-table">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Numéro</th>
                        <th>Capacité</th>
                        <th>Emplacement</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Table 1</td>
                        <td>4 personnes</td>
                        <td>Terrasse</td>
                        <td><span class="badge badge-success">Disponible</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Table 2</td>
                        <td>6 personnes</td>
                        <td>Intérieur</td>
                        <td><span class="badge badge-success">Disponible</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Table 3</td>
                        <td>2 personnes</td>
                        <td>Bar</td>
                        <td><span class="badge badge-danger">Réservée</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Commandes Section -->
        <div id="commandes" class="admin-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-receipt"></i>
                    Commandes récentes
                </h2>
                <div class="action-buttons">
                    <button class="btn btn-secondary">
                        <i class="fas fa-filter"></i> Filtrer
                    </button>
                </div>
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1254</td>
                        <td>Jean Dupont</td>
                        <td>12/11/2023 19:30</td>
                        <td>78€</td>
                        <td><span class="badge badge-success">Terminée</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Détails">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="table-btn" title="Imprimer">
                                <i class="fas fa-print"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#1253</td>
                        <td>Marie Lambert</td>
                        <td>12/11/2023 18:15</td>
                        <td>45€</td>
                        <td><span class="badge badge-primary">En cours</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Détails">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="table-btn" title="Imprimer">
                                <i class="fas fa-print"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#1252</td>
                        <td>Paul Martin</td>
                        <td>12/11/2023 13:45</td>
                        <td>62€</td>
                        <td><span class="badge badge-warning">En attente</span></td>
                        <td class="table-actions">
                            <button class="table-btn" title="Détails">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="table-btn" title="Imprimer">
                                <i class="fas fa-print"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Paiements Section -->
        <div id="paiements" class="admin-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-credit-card"></i>
                    Paiements
                </h2>
                <div class="action-buttons">
                    <button class="btn btn-secondary">
                        <i class="fas fa-download"></i> Exporter
                    </button>
                </div>
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Commande</th>
                        <th>Montant</th>
                        <th>Méthode</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#4587</td>
                        <td>#1254</td>
                        <td>78€</td>
                        <td>Carte bancaire</td>
                        <td><span class="badge badge-success">Payé</span></td>
                        <td>12/11/2023 19:32</td>
                        <td class="table-actions">
                            <button class="table-btn" title="Reçu">
                                <i class="fas fa-file-invoice"></i>
                            </button>
                            <button class="table-btn" title="Rembourser">
                                <i class="fas fa-undo"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#4586</td>
                        <td>#1253</td>
                        <td>45€</td>
                        <td>Espèces</td>
                        <td><span class="badge badge-success">Payé</span></td>
                        <td>12/11/2023 18:20</td>
                        <td class="table-actions">
                            <button class="table-btn" title="Reçu">
                                <i class="fas fa-file-invoice"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#4585</td>
                        <td>#1252</td>
                        <td>62€</td>
                        <td>Carte bancaire</td>
                        <td><span class="badge badge-warning">En attente</span></td>
                        <td>12/11/2023 13:50</td>
                        <td class="table-actions">
                            <button class="table-btn" title="Reçu">
                                <i class="fas fa-file-invoice"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Livraisons Section -->
        <div id="livraisons" class="admin-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-truck"></i>
                    Livraisons en cours
                </h2>
                <div class="action-buttons">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nouvelle livraison
                    </button>
                </div>
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Commande</th>
                        <th>Client</th>
                        <th>Livreur</th>
                        <th>Statut</th>
                        <th>Temps estimé</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#325</td>
                        <td>#1248</td>
                        <td>Sophie Bernard</td>
                        <td>Thomas L.</td>
                        <td><span class="badge badge-primary">En route</span></td>
                        <td>15 min</td>
                        <td class="table-actions">
                            <button class="table-btn" title="Suivre">
                                <i class="fas fa-map-marked-alt"></i>
                            </button>
                            <button class="table-btn" title="Terminer">
                                <i class="fas fa-check-circle"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#324</td>
                        <td>#1245</td>
                        <td>Lucie Petit</td>
                        <td>Marc D.</td>
                        <td><span class="badge badge-warning">En préparation</span></td>
                        <td>25 min</td>
                        <td class="table-actions">
                            <button class="table-btn" title="Attribuer">
                                <i class="fas fa-user-tie"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>#323</td>
                        <td>#1243</td>
                        <td>Pierre Moreau</td>
                        <td>Thomas L.</td>
                        <td><span class="badge badge-success">Livrée</span></td>
                        <td>-</td>
                        <td class="table-actions">
                            <button class="table-btn" title="Détails">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Livreurs Section -->
        <div id="livreurs" class="admin-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-user-tie"></i>
                    Gestion des livreurs
                </h2>
                <div class="action-buttons">
                    <button class="btn btn-primary" id="add-livreur">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Statut</th>
                        <th>Livraisons en cours</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Thomas Lambert</td>
                        <td>06 12 34 56 78</td>
                        <td><span class="badge badge-success">Disponible</span></td>
                        <td>1</td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Marc Dubois</td>
                        <td>06 87 65 43 21</td>
                        <td><span class="badge badge-warning">En pause</span></td>
                        <td>0</td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Alexandre Martin</td>
                        <td>06 45 67 89 01</td>
                        <td><span class="badge badge-danger">Indisponible</span></td>
                        <td>0</td>
                        <td class="table-actions">
                            <button class="table-btn" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="table-btn" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modals -->
    <!-- Modal Ajout/Modification Catégorie -->
    <div id="category-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="modal-title">
                <i class="fas fa-list"></i>
                Nouvelle Catégorie
            </h3>
            
            <form>
                <div class="form-group">
                    <label for="category-name">Nom de la catégorie</label>
                    <input type="text" id="category-name" placeholder="Ex: Entrées, Desserts..." required>
                </div>
                
                <div class="form-group">
                    <label for="category-description">Description</label>
                    <textarea id="category-description" rows="3" placeholder="Décrivez cette catégorie..."></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Ajout/Modification Plat -->
    <div id="plat-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="modal-title">
                <i class="fas fa-utensils"></i>
                Nouveau Plat
            </h3>
            
            <form>
                <div class="form-row">
                    <div class="form-group">
                        <label for="plat-name">Nom du plat</label>
                        <input type="text" id="plat-name" placeholder="Ex: Salade César..." required>
                    </div>
                    
                    <div class="form-group">
                        <label for="plat-category">Catégorie</label>
                        <select id="plat-category" required>
                            <option value="">Sélectionnez...</option>
                            <option value="1">Entrées</option>
                            <option value="2">Plats principaux</option>
                            <option value="3">Desserts</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="plat-price">Prix (€)</label>
                        <input type="number" id="plat-price" min="0" step="0.01" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="plat-status">Statut</label>
                        <select id="plat-status">
                            <option value="1">Disponible</option>
                            <option value="0">Indisponible</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="plat-description">Description</label>
                    <textarea id="plat-description" rows="3" placeholder="Ingrédients, particularités..."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="plat-image">Image</label>
                    <input type="file" id="plat-image" accept="image/*">
                    <img id="plat-image-preview" src="#" alt="Aperçu de l'image" style="max-width: 200px; margin-top: 10px; display: none;">
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Ajout Exception Horaire -->
    <div id="exception-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="modal-title">
                <i class="fas fa-calendar-times"></i>
                Ajouter une exception
            </h3>
            
            <form>
                <div class="form-row">
                    <div class="form-group">
                        <label for="exception-date">Date</label>
                        <input type="date" id="exception-date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="exception-type">Type</label>
                        <select id="exception-type" required>
                            <option value="">Sélectionnez...</option>
                            <option value="closed">Fermé</option>
                            <option value="special">Horaires spéciaux</option>
                        </select>
                    </div>
                </div>
                
                <div id="exception-hours" style="display: none;">
                    <div class="form-group">
                        <label>Horaires</label>
                        <div class="time-input">
                            <input type="time" id="exception-start">
                            <span>-</span>
                            <input type="time" id="exception-end">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="exception-description">Description</label>
                    <input type="text" id="exception-description" placeholder="Raison de l'exception...">
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des modals
            const modals = {
                category: document.getElementById('category-modal'),
                plat: document.getElementById('plat-modal'),
                exception: document.getElementById('exception-modal')
            };
            
            const openButtons = {
                category: document.getElementById('add-category'),
                plat: document.getElementById('add-plat'),
                exception: document.getElementById('add-exception')
            };
            
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
</body>
</html>