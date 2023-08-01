<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
</head>
<body>
    <section class="container">
        <div class="row">
            <div class="col-12">
                @include('layouts.header')
            </div>
            <div class="col-12 col-md-3">
                @include('layouts.navbar')
            </div>
            <div class="col-12 col-md-9">
                @include('layouts.mail_verify_noti')
                @yield('content')
            </div>
        </div>
    </section>

<script src="{{asset('js/bootstrap.bundle.js')}}"></script>
</body>
</html>
