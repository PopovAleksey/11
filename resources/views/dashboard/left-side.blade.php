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
                @foreach($menu as $item)
                    <li class="nav-item">
                        <a href="{{ route('dashboard_content_show', ['id' => $item->getId()]) }}"
                           class="nav-link {{ route('dashboard_content_show', ['id' => $item->getId()], false) === '/' . request()->path() ? 'active' : ''}}">
                            @if ($item->getType() === \App\Containers\Constructor\Page\Models\PageInterface::SIMPLE_TYPE)
                                <i class="far fa-file-alt"></i>&nbsp;
                            @elseif($item->getType() === \App\Containers\Constructor\Page\Models\PageInterface::BLOG_TYPE)
                                <i class="far fa-newspaper"></i>&nbsp;
                            @elseif($item->getType() === \App\Containers\Constructor\Page\Models\PageInterface::CATEGORY_TYPE)
                                <i class="far fa-list-alt"></i>&nbsp;
                            @endif
                            <p>{{$item->getName()}}</p>
                        </a>
                    </li>
                @endforeach
                <li class="nav-header">Settings</li>
                <a href="{{ route('dashboard_content_index') }}"
                   class="nav-link {{ route('dashboard_content_index', [], false) === '/' . request()->path() ? 'active' : ''}}">
                    <i class="fa-solid fa-list-check"></i>&nbsp;
                    <p>Menu</p>
                </a>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>