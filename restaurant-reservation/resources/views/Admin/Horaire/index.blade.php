@extends('Layouts.admin')

@section('content')

<!-- Horaires Section -->
<div id="horaires" class="admin-section">
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-clock"></i>
            Gestion des horaires
        </h2>
        <div class="action-buttons">
            <button class="btn btn-primary" id="add-exception">
                <i class="fas fa-plus"></i> Ajouter exception
            </button>
        </div>
    </div>
    
    <div class="calendar">
        <div class="calendar-header">Lundi</div>
        <div class="calendar-header">Mardi</div>
        <div class="calendar-header">Mercredi</div>
        <div class="calendar-header">Jeudi</div>
        <div class="calendar-header">Vendredi</div>
        <div class="calendar-header">Samedi</div>
        <div class="calendar-header">Dimanche</div>
        
        <div class="calendar-day">
            <div class="day-number">1</div>
            <div class="time-input" style="text-align: center;">Aucun horaire défini</div>
        </div>
        
        <div class="calendar-day">
            <div class="day-number">2</div>
            <div class="time-input" style="text-align: center;">Aucun horaire défini</div>
        </div>
        
        <div class="calendar-day">
            <div class="day-number">3</div>
            <div class="time-input" style="text-align: center;">Aucun horaire défini</div>
        </div>
        
        <div class="calendar-day">
            <div class="day-number">4</div>
            <div class="time-input" style="text-align: center;">Aucun horaire défini</div>
        </div>
        
        <div class="calendar-day">
            <div class="day-number">5</div>
            <div class="time-input" style="text-align: center;">Aucun horaire défini</div>
        </div>
        
        <div class="calendar-day">
            <div class="day-number">6</div>
            <div class="time-input" style="text-align: center;">Aucun horaire défini</div>
        </div>
        
        <div class="calendar-day">
            <div class="day-number">7</div>
            <div class="time-input" style="text-align: center;">Aucun horaire défini</div>
        </div>
    </div>
    
    <h3 style="margin-top: 2rem;">Jours exceptionnels</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Horaires</th>
                <th>Description</th>
                <th>Restaurant ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6" style="text-align: center;">Aucun jour exceptionnel ajouté pour le moment.</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection