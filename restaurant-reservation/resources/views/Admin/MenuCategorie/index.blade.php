@extends('Layouts.admin')

@section('content')
<!-- Menu Categories Section -->
    <div id="menu-categories" class="admin-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="fas fa-layer-group"></i>
                Catégories de menu
            </h2>
            <div class="action-buttons">
                <button class="btn btn-primary" id="add-category">
                    <i class="fas fa-plus"></i> Ajouter
                </button>
            </div>
        </div>
            
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Plats associés</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" style="text-align: center;">Aucune catégorie de menu ajoutée pour le moment.</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
