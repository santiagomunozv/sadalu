<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{URL::to('/')}}">
        <div class="sidebar-brand-icon">
        <img src="/images/LogoMenu.png" style="height: 3rem; width: 3rem;">
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @include('layouts.principal.menu')
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>