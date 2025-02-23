<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{config('app.name') .'-'. $page_title}}</title>

  <link rel="stylesheet" href="{{asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/fontawesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <style>
    body{
        background-color:#7d7d7d !important
    }
  </style>
</head>

<body>
  <div id="app">
    @yield('content')
  </div>

  <script src="{{asset('assets/modules/jquery.min.js')}}"></script>
  <script src="{{asset('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/custom.js')}}"></script>

  @include('backoffice.components.alert')
</body>
</html>