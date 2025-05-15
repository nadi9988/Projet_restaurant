@extends('Layouts.admin')

@section('content')
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
                <td colspan="7" style="text-align: center;">Aucune livraison en cours pour le moment.</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection