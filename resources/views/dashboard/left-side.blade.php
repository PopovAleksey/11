<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard_content_index') }}" class="brand-link">
        <span class="brand-text font-weight-light">
            &nbsp;<i class="fas fa-solar-panel"></i>&nbsp;&nbsp;&nbsp;
            Page Dashboard
        </span>
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
                        <a href="{{ route('dashboard_page_show', ['id' => $item->getId()]) }}"
                           class="nav-link {{ route('dashboard_page_show', ['id' => $item->getId()], false) === '/' . request()->path() ? 'active' : ''}}">
                            @if ($item->getType() === \App\Ship\Parents\Models\PageInterface::SIMPLE_TYPE)
                                <i class="far fa-file-alt"></i>&nbsp;
                            @elseif($item->getType() === \App\Ship\Parents\Models\PageInterface::BLOG_TYPE)
                                <i class="far fa-newspaper"></i>&nbsp;
                            @elseif($item->getType() === \App\Ship\Parents\Models\PageInterface::CATEGORY_TYPE)
                                <i class="far fa-list-alt"></i>&nbsp;
                            @endif
                            <p>{{$item->getName()}}</p>
                        </a>
                    </li>
                    @if($item->getType() === \App\Ship\Parents\Models\PageInterface::BLOG_TYPE)
                        <li class="nav-item">
                            <a href="{{ route('dashboard_page_show', ['id' => $item->getChildPage()->getId()]) }}"
                               class="nav-link {{ route('dashboard_page_show', ['id' => $item->getChildPage()->getId()], false) === '/' . request()->path() ? 'active' : ''}}">
                                <i class="fas fa-long-arrow-alt-right"></i>&nbsp;&nbsp;&nbsp;
                                <i class="far fa-file-alt"></i>&nbsp;
                                <p>{{$item->getChildPage()->getName()}}</p>
                            </a>
                        </li>
                    @endif
                @endforeach
                <li class="nav-header">Settings</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard_configuration_menu') }}"
                       class="nav-link {{ route('dashboard_configuration_menu', [], false) === '/' . request()->path() ? 'active' : ''}}">
                        <i class="fas fa-tasks"></i>&nbsp;
                        <p>Menu Configuration</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>