
<div id="restaurant-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3 class="modal-title">
            <i class="fas fa-store"></i>
                Nouveau Restaurant
        </h3>
        <form id="restaurant-form" action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nom">Nom du restaurant</label>
                <input type="text" name="nom" id="nom" class="form-control" required value="{{ old('nom') }}">
                @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" id="adresse" class="form-control" required value="{{ old('adresse') }}">
                    @error('adresse') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" name="telephone" id="telephone" class="form-control" required value="{{ old('telephone') }}">
                    @error('telephone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="image">Image du restaurant</label>
                <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Statut</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="statut" id="statut_actif" value="actif" {{ old('statut', 'actif') == 'actif' ? 'checked' : '' }}>
                    <label class="form-check-label" for="statut_actif">Actif</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="statut" id="statut_inactif" value="inactif" {{ old('statut') == 'inactif' ? 'checked' : '' }}>
                    <label class="form-check-label" for="statut_inactif">Inactif</label>
                </div>
                @error('statut') <small class="text-danger">{{ $message }}</small> @enderror
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
        
        <form id="category-form" action="{{ route('admin.menu-categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="category-name">Nom de la catégorie</label>
                <input type="text" id="category-name" name="nom" class="form-control" placeholder="Ex: Entrées, Desserts..." required value="{{ old('name') }}">
                @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="category-description">Description</label>
                <textarea id="category-description" name="description" class="form-control" rows="3" placeholder="Décrivez cette catégorie...">{{ old('description') }}</textarea>
                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="restaurant_id">Restaurant</label>
                <select id="restaurant_id" name="restaurant_id" class="form-control" required>
                    <option value="">Sélectionner un restaurant</option>
                        @if(isset($restaurants) && count($restaurants))
                            @foreach ($restaurants as $id => $nom)
                                <option value="{{ $id }}" {{ old('restaurant_id') == $id ? 'selected' : '' }}>{{ $nom }}</option>
                            @endforeach
                        @else
                            <option value="">Aucun restaurant disponible</option>
@endif
                </select>
                @error('restaurant_id') <small class="text-danger">{{ $message }}</small> @enderror
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
        
        <form method="POST" action="{{ route('admin.plat.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="plat-name">Nom du plat</label>
                    <input type="text" id="plat-name" name="nom" placeholder="Ex: Salade César..." required>
                </div>

                <div class="form-group">
                    <label for="plat-category">Catégorie</label>
                    <select id="plat-category" name="menu_categories_id" required>
                        <option value="">Sélectionnez...</option>
                        <option value="1">Entrées</option>
                        <option value="2">Plats principaux</option>
                        <option value="3">Desserts</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="plat-price">Prix (MAD)</label>
                    <input type="number" id="plat-price" name="prix" min="0" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="plat-status">Statut</label>
                    <select id="plat-status" name="disponible" required>
                        <option value="1">Disponible</option>
                        <option value="0">Indisponible</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="plat-description">Description</label>
                <textarea id="plat-description" name="description" rows="3" placeholder="Ingrédients, particularités..."></textarea>
            </div>

            <div class="form-group">
                <label for="plat-image">Image</label>
                <input type="file" id="plat-image" name="image" accept="image/*">
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

