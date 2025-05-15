@extends('Layouts.admin')

@section('content')
<div class="header">
    <h1 class="page-title">
        <i class="fas fa-tachometer-alt"></i>
        Tableau de bord
    </h1>
    <div class="user-info">
        <div class="user-avatar">AD</div>
        <span>Admin</span>
    </div>
</div>

<!-- Dashboard Cards -->
<div class="dashboard-cards">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Commandes aujourd'hui</h3>
            <div class="card-icon primary">
                <i class="fas fa-receipt"></i>
            </div>
        </div>
        <div class="card-value">24</div>
        <div class="card-footer">
            <i class="fas fa-arrow-up text-success"></i>
            <span>12% vs hier</span>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Réservations</h3>
            <div class="card-icon success">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
        <div class="card-value">18</div>
        <div class="card-footer">
            <i class="fas fa-arrow-up text-success"></i>
            <span>5% vs hier</span>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Chiffre d'affaires</h3>
            <div class="card-icon warning">
                <i class="fas fa-euro-sign"></i>
            </div>
        </div>
        <div class="card-value">1,245€</div>
        <div class="card-footer">
            <i class="fas fa-arrow-up text-success"></i>
            <span>8% vs hier</span>
        </div>
    </div>
</div>

<!-- Sections -->
@include('Admin.restaurants.index')
@include('Admin.menu-categories.index')
@include('Admin.plats.index')
@include('Admin.horaires.index')
@include('Admin.tables.index')
@include('Admin.commandes.index')
@include('Admin.paiements.index')
@include('Admin.livraisons.index')
@include('Admin.livreurs.index')

@endsection
