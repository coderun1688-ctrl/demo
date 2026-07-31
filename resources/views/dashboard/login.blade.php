<!DOCTYPE html>
<html translate="no">
<head>
<meta charset="UTF-8" />
<title>管理系統登入</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Widow-target" Content="_top">
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/css/jquery-confirm/jquery-confirm.css">
<link rel="stylesheet" type="text/css" href="/dashboard/css/login.css?v=@php echo time();@endphp">
<script type="text/javascript" src="/dashboard/jquery-3.7.1.js"></script>
<script type="text/javascript" src="/js/jquery-confirm/jquery-confirm.js"></script>
</head>
<body>
<div id="myForm">
    <div class="parent">
            <div class="login-page">
                <div class="form">
                    <p>管理系統</p>
                    <form class="login-form">
                        <input type="text" placeholder="email address" name="email" value="admin@admin.com"/>
                        <input type="password" placeholder="password" name="password" value="123456"/>
                        <button name="Send" type="button" onclick="Sendonclick();">
                            登入
                        </button>
                        <p class="message" style="height:20px;font-size: 14px;color: red;"></p>
                    </form>
                </div>
            </div>
    </div>
</div>
<script type="text/javascript" src="/dashboard/login.js?v=@php echo time();@endphp"></script>
</body>
</html>