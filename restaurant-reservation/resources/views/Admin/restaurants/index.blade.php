@extends('Layouts.admin')

@section('content')
    <!-- Section Restaurants -->
    <div id="restaurants" class="admin-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="fas fa-store"></i>
                Gestion des restaurants
            </h2>
            <div class="action-buttons">
                <button class="btn btn-primary" id="add-restaurant">
                    <i class="fas fa-plus"></i> Ajouter
                </button>
            </div>
        </div>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" style="text-align: center;">Aucun restaurant ajouté pour le moment.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal Restaurant -->
    <div id="restaurant-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="section-title">
                <i class="fas fa-store"></i>
                Nouveau Restaurant
            </h3>
        
            <form id="restaurant-form">
                <div class="form-group">
                    <label>Nom du restaurant</label>
                    <input type="text" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" required>
                    </div>
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="tel" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label>Galerie photos</label>
                    <input type="file" multiple accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('restaurant-modal');
            const addBtn = document.getElementById('add-restaurant');
            const closeBtn = modal.querySelector('.close');

            // Ouvrir le modal
            addBtn.addEventListener('click', () => modal.style.display = 'flex');
            
            // Fermer le modal
            closeBtn.addEventListener('click', () => modal.style.display = 'none');
            
            // Fermer en cliquant à l'extérieur
            window.addEventListener('click', (e) => {
                if(e.target === modal) modal.style.display = 'none';
            });
        });
    </script>
@endsection
