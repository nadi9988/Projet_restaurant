@extends('Layouts.admin')

@section('content')
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
                <td colspan="6" style="text-align: center;">Aucun livreur enregistré pour le moment.</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
