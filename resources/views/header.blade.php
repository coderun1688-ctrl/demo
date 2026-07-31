<!DOCTYPE html>
<html translate="no">
<head>
<meta charset="utf-8">
<title>{{(!empty($WebTitle) ? $WebTitle : $SystemSteeing['WebTitle'])}}</title>
<meta name="google" value="notranslate">
<meta name="description" content="{{(!empty($WebDescription) ? $WebDescription : $SystemSteeing['WebDescription'])}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Widow-target" Content="_top">
<meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport"/>
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="/css/fontawesome/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<link rel="stylesheet" type="text/css" href="/css/body.css?v=@php echo time();@endphp" />
<link rel="stylesheet" type="text/css" href="/css/jquery-confirm/jquery-confirm.css?v=@php echo time();@endphp">
<script type="text/javascript" src="/js/jquery-3.7.1.js"></script>
<script type="text/javascript" src="/js/bootstrap/bootstrap.bundle.js?v=@php echo time();@endphp"></script>
<script type="text/javascript" src="/js/jquery-confirm/jquery-confirm.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
<div class="search-popup">
    <div class="search-popup-container">

        <form role="search" method="POST" class="search-form" action="/Search">
            <input type="search" id="search-form" class="search-field" placeholder="請輸入關鍵字，按 Enter。" value="" name="s" />
            <button type="submit" class="search-submit" style="margin-top: 6px;"><i class="fa-regular fa-magnifying-glass fa-2xl"></i></button>
        </form>

        <h5 class="cat-list-title">Browse Categories</h5>
        <ul class="cat-list">
            <li class="cat-list-item">
                <a href="#" title="Mobile Phones">Mobile Phones</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Smart Watches">Smart Watches</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Headphones">Headphones</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Accessories">Accessories</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Monitors">Monitors</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Speakers">Speakers</a>
            </li>
            <li class="cat-list-item">
                <a href="#" title="Memory Cards">Memory Cards</a>
            </li>
        </ul>

    </div>
</div>

<header id="header" class="site-header header-scrolled position-fixed text-black bg-light">
    <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
        <div class="container-fluid" style="padding: 0;">
            <a class="navbar-brand" href="/">
                <img src="{{(!empty($SystemSteeing['WebLogoFile']) ? $SystemSteeing['WebLogoFile'] : '/image/main-logo.png')}}?v=@php echo time();@endphp" class="logo">
            </a>
            <div class="MenuSub" style="width:auto;padding-top:15px;">
                <ul class="d-flex justify-content-end list-unstyled">
                    <li class="search-item" style="width:40px;">
                        <a href="#" class="search-button">
                            <i class="fa-solid fa-magnifying-glass  fa-xl"></i>
                        </a>
                    </li>
                    <li class="dropdown" style="width:50px;">
                        <div class="btn-group">
                            <a  class="dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <i class="fa-solid fa-user fa-xl"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @if (Auth::guard('member')->check())
                                    <li><a class="dropdown-item" href="/PersonalCenter">個人中心</a></li>
                                    <li><a class="dropdown-item" href="/OrderList">訂單清單</a></li>

                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#" onclick="Logout()">登出</a></li>
                                @else

                                    <li style="height: 50px;">
                                        <div class="text-center">
                                            您未登入？
                                        </div>
                                    </li>
                                    <li style="height: 50px;padding: 5px;">

                                        <a href="/Login" class="btn btn-primary btn-sm">登入</a>

                                        <div class="float-end">
                                            <a href="/Register" class="btn btn-primary btn-sm">註冊</a>
                                        </div>

                                    </li>

                                @endif
                            </ul>
                        </div>

                    </li>
                    <li style="width:60px;" >
                        <a href="cart.html" class="position-relative"  >
                            <i class="fa-solid fa-cart-minus  fa-xl"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0
                          </span>
                        </a>
                    </li>

                </ul>
            </div>
            <a class="navbar-toggler d-flex d-lg-none order-3 p-2" style="border:unset;" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-light fa-bars"></i>
            </a>
            <div class="offcanvas offcanvas-end" style="border-left:0;" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
                <div class="offcanvas-header px-4 pb-0">
                    <a class="navbar-brand" href="/">
                        <img src="{{(!empty($SystemSteeing['WebLogoFile']) ? $SystemSteeing['WebLogoFile'] : '/image/main-logo.png')}}?v=@php echo time();@endphp" class="logo">
                    </a>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#bdNavbar"></button>
                </div>
                <div class="offcanvas-body">
                    <ul id="navbar" class="navbar-nav justify-content-end align-items-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link me-4 active" href="#billboard">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#company-services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#mobile-products">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#smart-watches">Watches</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#yearly-sale">Sale</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-4" href="#latest-blog">Blog</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link me-4 dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="about.html" class="dropdown-item">About</a>
                                </li>
                                <li>
                                    <a href="blog.html" class="dropdown-item">Blog</a>
                                </li>
                                <li>
                                    <a href="shop.html" class="dropdown-item">Shop</a>
                                </li>
                                <li>
                                    <a href="cart.html" class="dropdown-item">Cart</a>
                                </li>
                                <li>
                                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                                </li>
                                <li>
                                    <a href="single-post.html" class="dropdown-item">Single Post</a>
                                </li>
                                <li>
                                    <a href="single-product.html" class="dropdown-item">Single Product</a>
                                </li>
                                <li>
                                    <a href="contact.html" class="dropdown-item">Contact</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <div class="user-items ps-5">
                                <ul class="d-flex justify-content-end list-unstyled">
                                    <li class="search-item pe-3">
                                        <a href="#" class="search-button">
                                            <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                                        </a>
                                    </li>
                                    <li class="pe-3 dropdown">
                                        <div class="btn-group">
                                            <a  class="dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                                <i class="fa-solid fa-user fa-xl"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-lg-end">

                                                @if (Auth::guard('member')->check())
                                                    <li><a class="dropdown-item" href="/PersonalCenter">個人中心</a></li>
                                                    <li><a class="dropdown-item" href="/OrderList">訂單清單</a></li>

                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="#" onclick="Logout()">登出</a></li>
                                                @else

                                                    <li style="height: 50px;">
                                                            <div class="text-center">
                                                            您未登入？
                                                            </div>
                                                    </li>
                                                    <li style="height: 50px;padding: 5px;">

                                                        <a href="/Login" class="btn btn-primary btn-sm">登入</a>

                                                        <div class="float-end">
                                                            <a href="/Register" class="btn btn-primary btn-sm">註冊</a>
                                                        </div>

                                                    </li>

                                                @endif


                                            </ul>
                                        </div>

                                    </li>
                                    <li>
                                        <a href="cart.html" class="position-relative"  >
                                            <i class="fa-solid fa-cart-minus  fa-xl"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            0
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>


