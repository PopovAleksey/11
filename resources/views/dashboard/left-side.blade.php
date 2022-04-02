<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('constructor_language_index') }}" class="brand-link">
        <span class="brand-text font-weight-light">Page Constructor</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">Oleksii Popov</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header">Content</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard_content_index') }}" class="nav-link {{ route('dashboard_content_index', [], false) === '/' . request()->path() ? 'active' : ''}}">
                        <i class="fas fa-server"></i>&nbsp;
                        <p>Content</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>