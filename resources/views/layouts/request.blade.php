<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Yarakuzen Book Management - Assignment</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('/js/node_modules/toastr/build/toastr.css') }}" rel="stylesheet">
  <script data-main="{{ asset('/js/main') }}" src="{{ asset('/js/node_modules/requirejs/require.js') }}"></script>
</head>
<body data-yarakuzenurl="{{ Request::root() }}">
<div class="container">
  <div class="page-header">
    <h1>Yarakuzen Book Management <small>Assignment</small></h1>
  </div>
  <div id="page-content">
    @yield('content')
  </div>
</div>
</body>
</html>