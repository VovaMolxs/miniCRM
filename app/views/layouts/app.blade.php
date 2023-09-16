<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AppName - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<div class="row">
    <div class="sidebar col-md-3">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="min-height: 900px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-4">Mini CRM</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="/"></use></svg>
                            <a href="/" class="nav-link active" aria-current="page">
                                <svg class="bi me-2" width="16" height="16"><use xlink:href="/"></use></svg>
                                Home
                            </a>

                    </li>
                    <li>
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="/users"></use></svg>
                            <a href="/users" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16"><use xlink:href="/users"></use></svg>
                                Users
                            </a>
                    </li>
                    <li>
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="/roles"></use></svg>
                            <a href="/roles" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16"><use xlink:href="/roles"></use></svg>
                                Roles
                            </a>
                    </li>

                    <li>
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="/register"></use></svg>
                            <a href="/register" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16"><use xlink:href="/register"></use></svg>
                                Register
                            </a>
                    </li>
                    <li>
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="/login"></use></svg>
                            <a href="/login" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16"><use xlink:href="/login"></use></svg>
                                Login
                            </a>
                    </li>
                    <li>
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="/logout"></use></svg>
                            <a href="/logout" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16"><use xlink:href="/logout"></use></svg>
                                Logout
                            </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>mdo</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
        </div>
    </div>
    <div class="article col-md-9">
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>