@extends('user/layout')
@section('page_title', 'Homepage | The Ethical Man')
@section('content-wrapper')
    <!-- Banner -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active cursor-grab" id="first-banner">
                <img src="{{ asset('user_assets/images/Background-5.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 banner-text text-start">
                                <h2 class="display-5 text-black">We Define Style As Something That Is A Good Mix Of
                                    Ethics And Values</h2>
                                <Button class="btn bg-red rounded-pill text-white me-auto px-4">View More</Button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <img src="{{ asset('user_assets/images/The-Ethical-Man-Front-Banner.png') }}"
                                    class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item cursor-grab" id="second-banner">
                <img src="{{ asset('user_assets/images/Background-4.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 banner-text text-start">
                                <img src="{{ asset('user_assets/images/Smart-Banner-Text.png') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <img src="{{ asset('user_assets/images/Smart-Banner.png') }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item cursor-grab" id="third-banner">
                <img src="{{ asset('user_assets/images/Background-5.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 banner-text text-start">
                                <img src="{{ asset('user_assets/images/The-Ethical-Man-Shirt-Offer.png') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <img src="{{ asset('user_assets/images/Carousel-Banner.png') }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Banner ends -->

    <!-- Top Products -->
    <section class="pad50">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h5 class="f-600">Design of the Week</h5>
                    <p>Available In All Sizes</p>
                    <img src="{{ asset('user_assets/images/Secondary-yellow-Banner.png') }}" alt=""
                        class="img-fluid w-90">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <img src="{{ asset('user_assets/images/Secondary-blue-Banner.png') }}" alt="" class="img-fluid w-90">
                    <h5 class="f-600">Most Loved Product</h5>
                    <p>Shirts</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <h5 class="f-600">Customize Plain Colors</h5>
                    <p>New Shirt Edition</p>
                    <img src="{{ asset('user_assets/images/Secondary-red-Banner.png') }}" alt="" class="img-fluid w-90">
                </div>
            </div>
        </div>
    </section>
    <!-- Top Products ends -->

    <!-- Products  -->
    <section class="products pad50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="fs-2">
                            MEN'S FORMAL SHIRTS
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($data as $list)
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="card border-0" style="width: 90%;">
                            <a href="" class="product-img-link">
                                <img src="{{ asset('storage/media/' . $list->image . '') }}" class="card-img-top"
                                    alt="...">
                            </a>
                            <div class="card-body px-1 py-2 product-detail">
                                <span class="product-category">Shirt</span>
                                <a href="">
                                    <h6 class="product-name">{{ $list->name }}</h6>
                                </a>
                                <span class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                </span>
                                <p class="product-pricing">₹{{ $prod_attr[$data]->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card border-0" style="width: 90%;">
                        <a href="" class="product-img-link">
                            <img src="{{ asset('user_assets/images/product/Ethical-Man-Denim-Blue-Shirt.jpg') }}"
                                class="card-img-top" alt="...">
                        </a>
                        <div class="card-body px-1 py-2 product-detail">
                            <span class="product-category">Shirt</span>
                            <a href="">
                                <h6 class="product-name">The Ethical Man Denim Blue Shirt</h6>
                            </a>
                            <span class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </span>
                            <p class="product-pricing">₹1,499.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card border-0" style="width: 90%;">
                        <a href="" class="product-img-link">
                            <img src="{{ asset('user_assets/images/product/Ethical-man-denim-purple-shirt.jpg') }}"
                                class="card-img-top" alt="...">
                        </a>
                        <div class="card-body px-1 py-2 product-detail">
                            <span class="product-category">Shirt</span>
                            <a href="">
                                <h6 class="product-name">The Ethical Man Denim Purple Shirt</h6>
                            </a>
                            <span class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </span>
                            <p class="product-pricing">₹1,499.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card border-0" style="width: 90%;">
                        <a href="" class="product-img-link">
                            <img src="{{ asset('user_assets/images/product/Ethical-Man-Fiery-Red-Shirt.jpg') }}"
                                class="card-img-top" alt="...">
                        </a>
                        <div class="card-body px-1 py-2 product-detail">
                            <span class="product-category">Shirt</span>
                            <a href="">
                                <h6 class="product-name">The Ethical Man Fiery Red Shirt</h6>
                            </a>
                            <span class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </span>
                            <p class="product-pricing">₹1,499.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card border-0" style="width: 90%;">
                        <a href="" class="product-img-link">
                            <img src="{{ asset('user_assets/images/product/Ethical-Man-Forest-Green-Shirt.jpg') }}"
                                class="card-img-top" alt="...">
                        </a>
                        <div class="card-body px-1 py-2 product-detail">
                            <span class="product-category">Shirt</span>
                            <a href="">
                                <h6 class="product-name">The Ethical Man Forest Green Shirt</h6>
                            </a>
                            <span class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </span>
                            <p class="product-pricing">₹1,499.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card border-0" style="width: 90%;">
                        <a href="" class="product-img-link">
                            <img src="{{ asset('user_assets/images/product/Ethical-Man-Lava-Orange-Shirt.jpg') }}"
                                class="card-img-top" alt="...">
                        </a>
                        <div class="card-body px-1 py-2 product-detail">
                            <span class="product-category">Shirt</span>
                            <a href="">
                                <h6 class="product-name">The Ethical Man Lava Orange Shirt</h6>
                            </a>
                            <span class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </span>
                            <p class="product-pricing">₹1,499.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card border-0" style="width: 90%;">
                        <a href="" class="product-img-link">
                            <img src="{{ asset('user_assets/images/product/Ethical-Man-Light-Blue-Shirt.jpg') }}"
                                class="card-img-top" alt="...">
                        </a>
                        <div class="card-body px-1 py-2 product-detail">
                            <span class="product-category">Shirt</span>
                            <a href="">
                                <h6 class="product-name">The Ethical Man Light Blue Shirt</h6>
                            </a>
                            <span class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </span>
                            <p class="product-pricing">₹1,499.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="card border-0" style="width: 90%;">
                        <a href="" class="product-img-link">
                            <img src="{{ asset('user_assets/images/product/Ethical-Man-Phantom-Black-Shirt.jpg') }}"
                                class="card-img-top" alt="...">
                        </a>
                        <div class="card-body px-1 py-2 product-detail">
                            <span class="product-category">Shirt</span>
                            <a href="">
                                <h6 class="product-name">The Ethical Man Phantom Black Shirt</h6>
                            </a>
                            <span class="product-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </span>
                            <p class="product-pricing">₹1,499.00</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Products ends -->

    <!-- Bottom Banner -->
    <section class="bottom-banner" style="background-image: url('{{ asset('user_assets/images/bottom-banner.png') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 px-5">
                    <h3 class="text-black">Discover The Simple, Supportive, Effortless, And Elegant Collection
                    </h3>
                    <button class="btn bg-red text-white px-4">SHOP NOW ></button>
                </div>
            </div>
        </div>
    </section>
    <!-- Bottom Banner ends -->
@endsection
