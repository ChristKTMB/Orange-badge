<!-- need to remove -->
@if (auth()->user()->role != 'admin')
    <li class="nav-item">
        <a href="{{ route('badge.index') }}" class="nav-link {{ Request::is('badge') ? 'active' : '' }}">
            <i class="nav-icon fas fa-inbox"></i>
            <p>Mes demandes</p>
        </a>
    </li>
    @interim(auth()->user()->id)
        <li class="nav-item">
            <a href="{{ route('approbationInterim') }}"
                class="nav-link {{ Request::is('approbationInterim') ? 'active' : '' }}">
                <i class="nav-icon fas fa-inbox"></i>
                <p>Approbations</p>
            </a>
        </li>
    @endinterim
@endif
@if (auth()->user()->isApprover())
    <li class="nav-item">
        <a href="{{ route('approbation.index') }}" class="nav-link {{ Request::is('approbation') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tags"></i>
            <p>Mes approbations</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('interim') }}" class="nav-link {{ Request::is('interim') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-tag"></i>
            <p>Intérimaires</p>
        </a>
    </li>
@endif

@if (auth()->user()->role === 'admin')
    <li class="nav-item">
        <a href="{{ route('approving.index') }}" class="nav-link {{ Request::is('approving') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Approbateurs</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('direction.index') }}" class="nav-link {{ Request::is('direction') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Directions</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('categorie.index') }}" class="nav-link {{ Request::is('categorie') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Categorie de demande</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('graphique.index') }}" class="nav-link {{ Request::is('graphique') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Rapports</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('user') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>Utilisateurs</p>
        </a>
    </li>
@endif
