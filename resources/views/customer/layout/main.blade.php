<!DOCTYPE html>
<html lang="en">

<head>
    @include('customer.layout.head')
</head>

<body>
    <div id="loading"><span class="loader"></span></div>
    @include('customer.layout.header')
    <main>
        @yield('main')
    </main>
    @include('customer.layout.footer')
</body>

</html>
