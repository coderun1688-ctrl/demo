@include('header',['WebTitle'  =>  (!empty($WebTitle) ? $WebTitle : ''),'WebDescription'  =>  (!empty($WebDescription) ? $WebDescription : '')])
<section id="billboard" class="position-relative overflow-hidden bg-light-blue">
    <div class="swiper main-swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            <div class="banner-content">
                                <h1 class="display-2 text-uppercase text-dark pb-5">Your Products Are Great.</h1>
                                <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image-holder">
                                <img src="/image/banner-image.png" alt="banner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <div class="row d-flex flex-wrap align-items-center">
                        <div class="col-md-6">
                            <div class="banner-content">
                                <h1 class="display-2 text-uppercase text-dark pb-5">Technology Hack You Won't Get</h1>
                                <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image-holder">
                                <img src="/image/banner-image.png" alt="banner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-icon swiper-arrow swiper-arrow-prev">
        <i class="fa-sharp fa-solid fa-chevron-left fa-2xl" style="font-size: 6em;"></i>
    </div>
    <div class="swiper-icon swiper-arrow swiper-arrow-next">
        <i class="fa-sharp fa-solid fa-chevron-right fa-2xl" style="font-size: 6em;"></i>
    </div>
</section>
<section id="company-services" class="padding-large">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <i class="fa-solid fa-cart-flatbed-suitcase fa-2xl"></i>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">免運費</h3>
                        <p>全館消費滿 999 元免運費。</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <i class="fa-solid fa-medal fa-2xl"></i>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">品質保證</h3>
                        <p>品質保證，安心選購。</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <i class="fa-solid fa-badge-dollar fa-2xl"></i>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">每日優惠</h3>
                        <p>每天提供的特別優惠或折扣活動。</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <i class="fa-solid fa-shield fa-2xl"></i>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">100% 安全付款</h3>
                        <p>支援安全付款與加密交易。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="mobile-products" class="product-store position-relative padding-large no-padding-top">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">行動產品</h2>
                <div class="btn-right">
                    <a href="shop.html" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>
            <div class="swiper product-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="/image/product-item1.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 10</a>
                                </h3>
                                <span class="item-price text-primary">$980</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="/image/product-item2.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 11</a>
                                </h3>
                                <span class="item-price text-primary">$1100</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="/image/product-item3.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 8</a>
                                </h3>
                                <span class="item-price text-primary">$780</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="/image/product-item4.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 13</a>
                                </h3>
                                <span class="item-price text-primary">$1500</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="/image/product-item5.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Iphone 12</a>
                                </h3>
                                <span class="item-price text-primary">$1300</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>
<section id="smart-watches" class="product-store padding-large position-relative">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">智慧手錶</h2>
                <div class="btn-right">
                    <a href="shop.html" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>
            <div class="swiper product-watch-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="/image/product-item6.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Pink watch</a>
                                </h3>
                                <span class="item-price text-primary">$870</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="/image/product-item7.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Heavy watch</a>
                                </h3>
                                <span class="item-price text-primary">$680</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="/image/product-item8.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">spotted watch</a>
                                </h3>
                                <span class="item-price text-primary">$750</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="/image/product-item9.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">black watch</a>
                                </h3>
                                <span class="item-price text-primary">$650</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="/image/product-item10.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline"><use xlink:href="#cart-outline"></use></svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">black watch</a>
                                </h3>
                                <span class="item-price text-primary">$750</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>
<section id="yearly-sale" class="bg-light-blue overflow-hidden mt-5 padding-xlarge" style="background-image: url('/image/single-image1.png');background-position: right; background-repeat: no-repeat;">
    <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
            <div class="text-content offset-4 padding-medium">
                <h3>10% off</h3>
                <h2 class="display-2 pb-5 text-uppercase text-dark">新年特賣</h2>
                <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Sale</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">

        </div>
    </div>
</section>
<section id="latest-blog" class="padding-large">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">最新文章</h2>
                <div class="btn-right">
                    <a href="blog.html" class="btn btn-medium btn-normal text-uppercase">Read Blog</a>
                </div>
            </div>
            <div class="post-grid d-flex flex-wrap justify-content-between">
                <div class="col-lg-4 col-sm-12">
                    <div class="card border-none me-3">
                        <div class="card-image">
                            <img src="/image/post-item1.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="card-body text-uppercase">
                        <div class="card-meta text-muted">
                            <span class="meta-date">feb 22, 2023</span>
                            <span class="meta-category">- Gadgets</span>
                        </div>
                        <h3 class="card-title">
                            <a href="#">Get some cool gadgets in 2023</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card border-none me-3">
                        <div class="card-image">
                            <img src="/image/post-item2.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="card-body text-uppercase">
                        <div class="card-meta text-muted">
                            <span class="meta-date">feb 25, 2023</span>
                            <span class="meta-category">- Technology</span>
                        </div>
                        <h3 class="card-title">
                            <a href="#">Technology Hack You Won't Get</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card border-none me-3">
                        <div class="card-image">
                            <img src="/image/post-item3.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="card-body text-uppercase">
                        <div class="card-meta text-muted">
                            <span class="meta-date">feb 22, 2023</span>
                            <span class="meta-category">- Camera</span>
                        </div>
                        <h3 class="card-title">
                            <a href="#">Top 10 Small Camera In The World</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script type="text/javascript" src="/js/plugins.js"></script>

@include('footer')