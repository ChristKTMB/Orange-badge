<!-- need to remove -->

<li class="nav-item">
    <a href="{{ route('badge.index') }}" class="nav-link {{ Request::is('badge') ? 'active' : '' }}">
        <i class="nav-icon fas fa-inbox"></i>
        <p>Mes demandes</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('approving.index') }}" class="nav-link {{ Request::is('approving') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Approbateurs</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('direction.index') }}" class="nav-link {{ Request::is('direction') ? 'active' : '' }}">
        <i class="nav-icon fas fa-receipt"></i>
        <p>Directions</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('approbation.index') }}" class="nav-link {{ Request::is('approbation') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tags"></i>
        <p>Mes approbations</p>
    </a>
</li>