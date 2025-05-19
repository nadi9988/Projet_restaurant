@extends('admin.admin')

@section('content')
<div id="plats" class="admin-section">
    <div class="section-header">
        <h2 class="section-title">
            <i class="fas fa-utensils"></i> Gestion des plats
        </h2>
        <div class="action-buttons">
            <button class="btn btn-primary" id="add-plat">
                <i class="fas fa-plus"></i> Ajouter
            </button>
        </div>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($plats as $plat)
                <tr>
                    <td>{{ $plat->id }}</td>
                    <td>
                        @if ($plat->image)
                            <img src="{{ $plat->image }}" style="width: 60px;">
                        @else
                            <span>–</span>
                        @endif
                    </td>
                    <td>{{ $plat->nom }}</td>
                    <td>{{ $plat->menuCategorie->nom ?? '-' }}</td>
                    <td>{{ $plat->getRawPrix() }} MAD</td>
                    <td>{{ $plat->disponible }}</td>
                    <td>
                        <a href="{{ route('admin.plat.show', $plat) }}" class="btn btn-sm btn-info">Voir</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align: center;">Aucun plat trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        // CSRF Token setup for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Ouvrir modale Plat
        $('#add-plat').on('click', function () {
            $('#plat-modal').show();
        });

        // Fermer modale
        $('.close').on('click', function () {
            $(this).closest('.modal').hide();
            $('#plat-form')[0].reset();
            $('#plat-image-preview').hide();
            $('.text-danger').remove();
        });

        // Image preview
        $('#plat-image').on('change', function () {
            const [file] = this.files;
            if (file) {
                $('#plat-image-preview').attr('src', URL.createObjectURL(file)).show();
            } else {
                $('#plat-image-preview').hide();
            }
        });

        // AJAX Submit
        $('#plat-form').submit(function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            $('.text-danger').remove();

            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function () {
                    alert("Plat ajouté avec succès !");
                    $('#plat-form')[0].reset();
                    $('#plat-image-preview').hide();
                    $('#plat-modal').hide();
                    location.reload(); // ou mettre à jour dynamiquement le tableau
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        let input = $('[name="' + key + '"]');
                        input.after('<small class="text-danger">' + value[0] + '</small>');
                    });
                }
            });
        });
    });
</script>
@endsection
