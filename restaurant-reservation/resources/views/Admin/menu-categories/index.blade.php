@extends('admin.admin')

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
            @forelse ($categories as $categorie)
                <tr>
                    <td>{{ $categorie->id }}</td>
                    <td>{{ $categorie->nom }}</td>
                    <td>{{ $categorie->description }}</td>
                    <td>{{ $categorie->plats_count }}</td>
                    <td>
                        <a href="{{ route('admin.menu-categories.show', $categorie) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('admin.menu-categories.edit', $categorie) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('admin.menu-categories.destroy', $categorie) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune catégorie de menu ajoutée pour le moment.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-3">
        {{ $categories->links() }}
    </div>
</div>



<!-- JavaScript -->
<script>
    $(document).ready(function () {
        // Protection CSRF pour AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#category-form').submit(function (e) {
            e.preventDefault();

            var form = $(this);
            var actionUrl = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                url: actionUrl,
                method: "POST",
                data: formData,
                success: function (response) {
                    $('#category-modal').hide();
                    alert("Catégorie ajoutée avec succès !");
                    location.reload(); // ou mise à jour dynamique du tableau
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    $('.text-danger').remove();

                    $.each(errors, function (key, value) {
                        let input = $('[name="' + key + '"]');
                        input.after('<small class="text-danger">' + value[0] + '</small>');
                    });
                }
            });
        });

        // Ouvrir la modale
        $('#add-category').on('click', function () {
            $('#category-modal').show();
        });

        // Fermer la modale
        $('.close').on('click', function () {
            $('#category-modal').hide();
        });
    });
</script>
@endsection
