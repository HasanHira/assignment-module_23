<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>X-Bakery</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/favicon.ico')}}" />
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/fontawesome.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/toastify.min.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/css/datatables.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables.min.js')}}"></script>

    <script src="{{asset('assets/js/toastify-js.js')}}"></script>
    <script src="{{asset('assets/js/axios.min.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
</head>

<body>

<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
</div>

<nav class="navbar fixed-top px-0 shadow-sm bg-white">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                <img class="nav-logo-sm mx-2"  src="{{asset('assets/images/menu.svg')}}" alt="logo"/>
            </span>
            <img class="nav-logo  mx-2"  src="{{asset('assets/images/logo.png')}}" alt="logo"/>
        </a>

        <div class="float-right h-auto d-flex">
            <div class="user-dropdown">
                <img class="icon-nav-img" src="{{asset('assets/images/user.webp')}}" alt=""/>
                <div class="user-dropdown-content ">
                    <div class="mt-4 text-center">
                        <img class="icon-nav-img" src="{{asset('assets/images/user.webp')}}" alt=""/>
                        <h6>User Name</h6>
                        <hr class="user-dropdown-divider  p-0"/>
                    </div>
                    <a href="{{url('/profile-page')}}" class="side-bar-item">
                        <span class="side-bar-item-caption">Profile</span>
                    </a>
                    <a href="{{url('/logout')}}" class="side-bar-item">
                        <span class="side-bar-item-caption">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>


<div id="sideNavRef" class="side-nav-open">
    {{-- Dashboard nav --}}
    <a href="{{url("/dashboard")}}" class="side-bar-item side-bar-item">
        <i class="fas fa-th-large text-dark"></i>
        <span class="side-bar-item-caption">Dashboard</span>
    </a>
    <a href="{{url("/category-page")}}" class="side-bar-item">
        <i class="fas fa-boxes text-dark"></i>
        <span class="side-bar-item-caption">Category</span>
    </a>
</div>


<div id="contentRef" class="content">
    @yield('content')
</div>

<script src="{{asset('assets/js/bootstrap.bundle.js')}}"></script>

<script>
    function MenuBarClickHandler() {
        let sideNav = document.getElementById('sideNavRef');
        let content = document.getElementById('contentRef');
        if (sideNav.classList.contains("side-nav-open")) {
            sideNav.classList.add("side-nav-close");
            sideNav.classList.remove("side-nav-open");
            content.classList.add("content-expand");
            content.classList.remove("content");
        } else {
            sideNav.classList.remove("side-nav-close");
            sideNav.classList.add("side-nav-open");
            content.classList.remove("content-expand");
            content.classList.add("content");
        }
    }

</script>

</body>
</html>
