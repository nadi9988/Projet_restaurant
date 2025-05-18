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
            <button class="btn btn-primary" id="add-restaurant">
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
                <th>Photo</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($restaurants as $restaurant)
                <tr>
                    <td>{{ $restaurant->id }}</td>
                    <td>{{ $restaurant->nom }}</td>
                    <td>{{ $restaurant->adresse }}</td>
                    <td>{{ $restaurant->formatted_phone }}</td>
                    <td>
                        @if($restaurant->image)
                            <img src="{{ asset('storage/' . $restaurant->image) }}" alt="Image du restaurant" width="80" height="60" style="object-fit: cover; border-radius: 5px;">
                        @else
                            <span class="text-muted">Aucune image</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($restaurant->description, 50) }}</td>
                    <td>
                        @if($restaurant->is_active)
                            <span class="badge badge-success">Actif</span>
                        @else
                            <span class="badge badge-danger">Inactif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> 
                        </a>
                        <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce restaurant ?')">
                                <i class="fas fa-trash"></i> 
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Aucun restaurant ajouté pour le moment.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection