@extends('Layouts.admin')

@section('content')

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
                <td colspan="7" style="text-align: center;">Aucun plat ajouté pour le moment.</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection