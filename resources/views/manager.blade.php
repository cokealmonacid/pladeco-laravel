<html>
<head>
    <title> @yield('title') </title>

  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  <!-- Material Design fonts -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

  <!-- Bootstrap Material Design -->
  <link rel="stylesheet" type="text/css" href="/css/bootstrap-material-design.css">
  <link rel="stylesheet" type="text/css" href="/css/ripples.min.css">

  <!-- Main css for manager -->
  <link rel="stylesheet" type="text/css" href="/css/main.css">

</head>
<body>
@include('shared.navbar-manager')
@yield('content')
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>

<script>
    $(document).ready(function() {
        // This command is used to initialize some elements and make them work properly
        $.material.init();
    });
</script>
<script type="text/javascript">

</script> 
</body>

</html>