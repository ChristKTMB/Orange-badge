<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('badge.index') }}" class="nav-link {{ Request::is('badge.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Historique</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('badge.index') }}" class="nav-link {{ Request::is('badge.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Approving</p>
    </a>
</li>