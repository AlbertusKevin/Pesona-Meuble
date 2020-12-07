{{--
    Copyright (C) 2020 PBBO Persona Meuble - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Code's Author by Albertus Kevin, Chris Christian, Mikhael Adriel, December 2020 
--}}

<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">


</head>

<body class="antialiased">
    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand" href="">Pesona.</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin">Product</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-procurement" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sales Order</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-procurement">
                            <a class="dropdown-item" href="/salesorder">List</a>
                            <a class="dropdown-item" href="/salesorder/history">History</a>
                            <a class="dropdown-item" href="/salesorder/create">New</a>
                            <a class="dropdown-item" href="/delivery">Delivery</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="dropdown-procurement" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Procurement</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-procurement">
                            <a class="dropdown-item" href="/procurement/list">List</a>
                            <a class="dropdown-item" href="/procurement/history">History</a>
                            <a class="dropdown-item" href="/procurement/create">New</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="/customer/list">Customer Management</a>
                            <a class="dropdown-item" href="/vendor/list">Vendor Management</a>
                            <a class="dropdown-item" href="/employee/list">Employee Management</a>
                            <a class="dropdown-item" href="/discount/list">Finance</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="/logout">
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</button>
                </form>
            </div>
        </nav>
    </header>
    @yield('content')
    <footer>
        <div class="row footer w-100">
            <div class="col-12 col-sm-8 w-100 footerparagraph">
                <h1> Become a member</h1>
                <p class="pt-2">Sed habitant porttitor at volutpat at. Suscipit a id velit scelerisque leo mi sit. Amet, mauris morbi mauris est elit. In mi, proin accumsan egestas cras quam massa feugiat dui. Odio sed scelerisque libero arcu magna nisl eget id elementum.</p>
            </div>

            <div class="col-12 col-sm-4 w-100">
                <h2 class="pl-4 ">LOGO</h2>
                <ul>
                    <li class="pt-4 pb-2" style="list-style:none;"><a class="footerlinks">Terms & Conditions</a></li>
                    <li class="pb-2" style="list-style:none;"><a class="footerlinks">Privacy Policy</a></li>
                    <li class="pb-2" style="list-style:none;"><a class="footerlinks">About Us</a></li>
                    <li class="pb-2" style="list-style:none;"><a class="footerlinks">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/script.js') }}" defer></script>


</html>