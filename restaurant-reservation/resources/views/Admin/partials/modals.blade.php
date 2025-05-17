<!-- Modals -->
    <!-- Modal Ajout/Modification Catégorie -->
@extends('admin.admin')
@section('content')
<div id="restaurant-modal" class="modal">
        <div class="modal-content">
        <span class="close">&times;</span>
        <h3 class="modal-title">
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
                <div class="gallery-grid" id="gallery-preview"></div>
             </div>
        
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </form>
    </div>
</div>
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
@endsection
