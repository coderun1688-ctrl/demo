<!DOCTYPE html>
<html>
<head>
<title>關閉維護</title>
<meta http-equiv="Widow-target" Content="_top">
<meta name="robots" content="none">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="/css/fontawesome/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/css/WebHome.css?v=@php echo time();@endphp" />
</head>
<body>
<div class="container parent">
    <div class="alert alert-light" role="alert">
        {!! str_replace("\n","<br>",$content) !!}
    </div>
</div>
</body>
</html>