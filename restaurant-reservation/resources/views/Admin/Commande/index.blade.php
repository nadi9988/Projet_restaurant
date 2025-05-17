@extends('admin.admin')

@section('content')
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
                <td colspan="6" style="text-align: center;">Aucune commande enregistrée pour le moment.</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
