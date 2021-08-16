<!DOCTYPE html>
<html>
<head>
    <link href="/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
    <title>Constructor - @yield('title')</title>
</head>
<body>
<script src="/js/bootstrap.js" crossorigin="anonymous"></script>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('web_site_index')}}">Constructor</a>



            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create Site
            </button>



            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @section('menu-links')
                        {{--<li class="nav-item">
                            <a class="btn btn-success" aria-current="page" href="{{route('web_site_index')}}">Create
                                Site</a>
                        </li>--}}
                    @show
                </ul>

                <a href="{{route('post_logout')}}" type="button" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>
    <div class="content">
        @yield('content')
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>