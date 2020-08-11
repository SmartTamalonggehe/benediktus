<!doctype html>
<html lang="en">

<head>
    <meta name="csrf_token" content="{{csrf_token()}}">
    <meta charset="utf-8" />
    <title>@yield('judul')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assetsAdmin/images/favicon.ico') }}">

    @yield('css')

    <!-- Bootstrap Css -->
     <link href="{{ asset('assetsAdmin/css/bootstrap-dark.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assetsAdmin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

     <link href="{{ asset('assetsAdmin/css/app-dark.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />



</head>

<body data-layout="detached" data-topbar="colored">
