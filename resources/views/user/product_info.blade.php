@extends('user/layout')
@section('page_title', 'Homepage | The Ethical Man')
@section('additional_css')
    <!-- xZoom Plugin -->
    <script src="{{ asset('user_assets/assets/plugins/xZoom/jquery.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('user_assets/plugins/xZoom/xzoom.css') }}" media="all" />
    <link type="text/css" rel="stylesheet" media="all"
        href="{{ asset('user_assets/plugins/xZoom/magnific-popup.css') }}" />
    <script type="text/javascript" src="{{ asset('user_assets/assets/plugins/xZoom/xzoom.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user_assets/assets/plugins/xZoom/magnific-popup.js') }}"></script>
@endsection

@section('content-wrapper')
    <section class="product-info py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Product images -->
                    <div id="magnific">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="xzoom-container w-100 text-center">
                                    <img class="xzoom5 w-70" id="xzoom-magnific"
                                        src="{{ asset('storage/media/' . $data[0]->image . '') }}"
                                        xoriginal="{{ asset('storage/media/' . $data[0]->image . '') }}" />
                                    <div class="xzoom-thumbs">
                                        @foreach ($prod_img[$data[0]->id] as $list)
                                            <?php
                                            // echo '<pre>';
                                            // print_r($list);
                                            ?>
                                        @endforeach
                                        <a href="{{ asset('storage/media/' . $list->images . '') }}">
                                            <img class="xzoom-gallery5" width="80"
                                                src="{{ asset('storage/media/' . $list->images . '') }}"
                                                xpreview="{{ asset('storage/media/' . $list->images . '') }}"
                                                title="The description goes here">
                                        </a>
                                        <a href="{{ asset('storage/media/' . $list->images . '') }}">
                                            <img class="xzoom-gallery5" width="80"
                                                src="{{ asset('storage/media/' . $list->images . '') }}"
                                                title="The description goes here">
                                        </a>
                                        <a href="{{ asset('storage/media/' . $list->images . '') }}">
                                            <img class="xzoom-gallery5" width="80"
                                                src="{{ asset('storage/media/' . $list->images . '') }}"
                                                title="The description goes here">
                                        </a>
                                        <a href="{{ asset('storage/media/' . $list->images . '') }}">
                                            <img class="xzoom-gallery5" width="80"
                                                src="{{ asset('storage/media/' . $list->images . '') }}"
                                                title="The description goes here">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Shirt</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $data[0]->name }}</li>
                        </ol>
                    </nav>
                    <h3>{{ $data[0]->name }}</h3>
                    <h4>₹1,499.00</h4>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Enter Pincode"
                                    aria-label="Enter Pincode" aria-describedby="button-addon2">
                                <button class="btn bg-red text-white" type="button" id="button-addon2"
                                    style="z-index: 0;">Check Pincode</button>
                            </div>
                        </div>
                    </div>
                    <div class="product-detail">
                        {!! $data[0]->short_desc !!}
                    </div>
                    <br>
                    <div class="size-option row">
                        <div class="col-6">
                            <h6>Size</h6>
                            <select class="form-select" aria-label="Default select example">
                                <option selected value="">38</option>
                                <option value="">40</option>
                                <option value="">42</option>
                                <option value="">44</option>
                                <option value="">46</option>
                            </select>
                        </div>
                    </div>
                    <div class="row my-2">
                        <hr class="mb-3 w-70">
                        <div class="col-12 d-flex">
                            <input type="number" value="1" style="width: 10%;height: 100%;" class="mx-2 text-center"><button
                                class="btn bg-red text-white">Add To Cart</button>
                        </div>
                        <hr class="mt-3 w-70">
                    </div>
                    <div class="sku">
                        <p>SKU : <span>TEM01002</span></p>
                    </div>
                    <div class="caterory">
                        <p>Category : <span class="text-red">Shirt</span></p>
                    </div>
                    <div class="share-social-product">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-10 mx-auto">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-additional-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-additional" type="button" role="tab" aria-controls="nav-additional"
                                aria-selected="true">Additional Information</button>
                            <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review"
                                aria-selected="false">Review <span>(0)</span></button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-additional" role="tabpanel"
                            aria-labelledby="nav-additional-tab">
                            <table class="table table-striped table-bordered my-3">
                                <tbody>
                                    <tr>
                                        <th scope="row">Weight</th>
                                        <td>.25Kg</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Size</th>
                                        <td>38,40,42,44,46,48</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                            <div class="review-star my-3">
                                <h3>Review</h3>
                                <div class="star-rating row align-items-center">
                                    <div class="product-rating col-lg-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <div class="col-lg-10 p-0">
                                        <div class="progress" style="height: .5rem;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="star-rating row align-items-center">
                                    <div class="product-rating col-lg-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <div class="col-lg-10 p-0">
                                        <div class="progress" style="height: .5rem;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="star-rating row align-items-center">
                                    <div class="product-rating col-lg-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <div class="col-lg-10 p-0">
                                        <div class="progress" style="height: .5rem;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="star-rating row align-items-center">
                                    <div class="product-rating col-lg-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <div class="col-lg-10 p-0">
                                        <div class="progress" style="height: .5rem;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="star-rating row align-items-center">
                                    <div class="product-rating col-lg-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <div class="col-lg-10 p-0">
                                        <div class="progress" style="height: .5rem;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-3 related-products">
                <div class="col-10 mx-auto">
                    <h5 class="f-700 text-black">Related Products</h5>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="card border-0" style="width: 90%;">
                                <a href="product-info" class="product-img-link">
                                    <img src="./images/product/Ethical-Man-Classic-Purple-Shirt.jpg" class="card-img-top"
                                        alt="...">
                                </a>
                                <div class="card-body px-1 py-2 product-detail">
                                    <span class="product-category">Shirt</span>
                                    <a href="product-info">
                                        <h6 class="product-name">The Ethical Man Classic Purple Shirt</h6>
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
                                <a href="product-info" class="product-img-link">
                                    <img src="./images/product/Ethical-Man-Denim-Blue-Shirt.jpg" class="card-img-top"
                                        alt="...">
                                </a>
                                <div class="card-body px-1 py-2 product-detail">
                                    <span class="product-category">Shirt</span>
                                    <a href="product-info">
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
                                    <img src="./images/product/Ethical-man-denim-purple-shirt.jpg" class="card-img-top"
                                        alt="...">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('additional_js')
    <script src="{{ asset('user_assets/assets/plugins/xZoom/setup.js') }}"></script>
@endsection
