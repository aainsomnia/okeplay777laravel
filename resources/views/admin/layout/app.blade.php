<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Okeadmin &mdash; @yield('title') </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('admin/css/app.css')}}">
    <link rel="shortcut icon" href="{{ asset('admin/img/logostore.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
</head>

<body>
    @if(request()->segment(2) != "login")
    <div id="app">

        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('admin/img/avatar-1.png') }}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->user_fname }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('/') }}">
                            <img alt="image" src="{{ asset('web/images/okeplaylogo7777.gif')}}" alt="logo" width="80" class="">
                        </a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/') }}">
                            <img alt="image" src="{{ asset('web/images/okeplaylogo7777.gif')}}" alt="logo" width="60" class="">
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Main Menus</li>
                        <li class="nav-item {{ request()->segment(2) == "category" ? 'active' : ""}}">
                            <a href="{{ route('category.view') }}" class="nav-link"><i class="fas fa-tags"></i><span>Category</span></a>
                        </li>
                        <li class="nav-item {{ request()->segment(2) == "content" ? 'active' : ""}}">
                            <a href="{{ route('content.view') }}" class="nav-link"><i class="fas fa-th-large"></i></i><span>Content</span></a>
                        </li>
                        <li class="nav-item {{ request()->segment(2) == "banner" ? 'active' : ""}}">
                            <a href="{{ route('banner.view') }}" class="nav-link"><i class="fas fa-solid fa-images"></i></i><span>Banner</span></a>
                        </li>
                        <li class="nav-item {{ request()->segment(2) == "setting" ? 'active' : ""}}">
                            <a href="{{ route('setting.view') }}" class="nav-link"><i class="fas fa-cog"></i></i><span>Settings</span></a>
                        </li>
                </aside>
            </div>

            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2022
                </div>
                <div class="footer-right">
                    Version 1.0
                </div>
            </footer>
        </div>

    </div>
    @else
        @yield('content')
    @endif
    @yield('modal')
    <script src="{{ asset('admin/js/app.js') }}"></script>
    <script src="{{ asset('admin/js/stisla.js') }}"></script>
    <script src="{{ asset('admin/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <script>

        function button_loading(t,text,disabled) {
            $(t).prop("disabled", disabled);
            if (disabled){
                $(t).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);
            } else {
                $(t).html(text);
            }
        }

        function delaySearchTable(callback, ms) {
            var timer = 0;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }

    </script>
    @yield('scripts')
</body>
</html>
