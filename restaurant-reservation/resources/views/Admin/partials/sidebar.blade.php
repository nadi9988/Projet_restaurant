
<div class="sidebar">
    <div class="logo">
        <i class="fas fa-utensils"></i>
        <h1>RestoReserve</h1>
    </div>
    
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('admin.restaurants.index') }}" class="nav-link {{ request()->routeIs('admin.restaurants.*') ? 'active' : '' }}">
                <i class="fas fa-store"></i>
                <span>Restaurants</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.menu-categories.index') }}" class="nav-link {{ request()->routeIs('admin.menu-categories.*') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                <span>Catégories</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.plat.index') }}" class="nav-link {{ request()->routeIs('admin.plat.*') ? 'active' : '' }}">
                <i class="fas fa-utensils"></i>
                <span>Plats</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.horaire.index') }}" class="nav-link {{ request()->routeIs('admin.horaire.*') ? 'active' : '' }}">
                <i class="fas fa-clock"></i>
                <span>Horaires</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.table.index') }}" class="nav-link {{ request()->routeIs('admin.table.*') ? 'active' : '' }}">
                <i class="fas fa-chair"></i>
                <span>Tables</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.commande.index') }}" class="nav-link {{ request()->routeIs('admin.commande.*') ? 'active' : '' }}">
                <i class="fas fa-receipt"></i>
                <span>Commandes</span>
            </a>
        </li>
    </ul>
</div>
