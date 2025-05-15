@extends('Layouts.admin')

@section('content')
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
                <th>Restaurant ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" style="text-align: center;">Aucune table définie pour le moment.</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
