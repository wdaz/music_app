<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title-block')</title>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
</head>
<body class=".bg-light.bg-gradient">
@include('inc.header')

<div class="content">
    @yield('content')
</div>


@include('inc.footer')
</body>
</html>
