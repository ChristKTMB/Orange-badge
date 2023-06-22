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
        <p>Historic</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('approving.index') }}" class="nav-link {{ Request::is('approving') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Approbateurs</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('direction.index') }}" class="nav-link {{ Request::is('direction.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Direction</p>
    </a>
</li>
<!-- <li class="nav-item">
    <a href="{{ route('badge.showBadge') }}" class="nav-link {{ Request::is('badge.showBadge') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Badge</p>
    </a>
</li> -->
