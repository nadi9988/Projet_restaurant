@extends('admin.admin')

@section('content')
    <!-- Section Restaurants -->
<div id="restaurants" class="admin-section">
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-store"></i>
            Gestion des restaurants
        </h2>
        <div class="action-buttons">
            <button class="btn btn-primary" id="add-restaurants">
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
@endsection
