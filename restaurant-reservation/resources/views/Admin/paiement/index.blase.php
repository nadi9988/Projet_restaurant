@extends('admin.admin')

@section('content')


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
                <td colspan="7" style="text-align: center;">Aucun paiement enregistré pour le moment.</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
