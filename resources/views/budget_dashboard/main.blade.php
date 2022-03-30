<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    @include('budget_dashboard.header')
    @yield('css')
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        @include('budget_dashboard.navbar')

        @include('budget_dashboard.sidebar')
        <div class="page-wrapper">
            @yield('content')
            <!-- <footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://wrappixel.com">WrapPixel</a>.
            </footer> -->
        </div>
    </div>
    @include('budget_dashboard.js')
    @yield('budgetscript')
</body>
</html>