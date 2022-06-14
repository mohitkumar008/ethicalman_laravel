@extends('user/layout')
@section('page_title', $data[0]->name . ' | The Ethical Man')
@section('additional_css')
    <link rel="stylesheet" href="{{ asset('user_assets/assets/plugins/smooth/css/smoothproducts.css') }}">
    <link rel="stylesheet" href="{{ asset('user_assets/assets/plugins/OwlCarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user_assets/assets/plugins/OwlCarousel/owl.theme.default.min.css') }}">
    <style>
        /* Rating Star Widgets Style */
        .rating-stars ul {
            list-style-type: none;
            padding: 0;

            -moz-user-select: none;
            -webkit-user-select: none;
        }

        .rating-stars ul>li.star {
            display: inline-block;

        }

        /* Idle State of the stars */
        .rating-stars ul>li.star>i.fa {
            font-size: 1.5em;
            /* Change the size of the stars */
            color: #ccc;
            /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul>li.star.hover>i.fa {
            color: #FFCC36;
        }

        /* Selected state of the stars */
        .rating-stars ul>li.star.selected>i.fa {
            color: #FF912C;
        }

    </style>
@endsection

@section('content-wrapper')
    <section class="product-info py-5">
        <div class="container">
            <div class="row alert-box">
                @if (session('review_msg'))
                    <div class="col-lg-10 col-md-10 col-12 mx-auto">
                        <p><i class="bi bi-patch-check-fill text-red me-2"></i> {{ session('review_msg') }}</p>
                    </div>
                @endif
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5 ml-auto">
                    <!-- Product images -->
                    <div class="sp-wrap text-center">
                        <a href="{{ asset('storage/media/' . $data[0]->image . '') }}"><img
                                src="{{ asset('storage/media/' . $data[0]->image . '') }}" alt="" width="100%"></a>
                        @foreach ($prod_img[$data[0]->id] as $list)
                            <a href="{{ asset('storage/media/' . $list->images . '') }}"><img
                                    src="{{ asset('storage/media/' . $list->images . '') }}" alt=""></a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Shirt</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $data[0]->name }}</li>
                        </ol>
                    </nav>
                    <h3>{{ $data[0]->name }}</h3>
                    <h4>₹1,499.00</h4>
                    {{-- <div class="row">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Enter Pincode"
                                    aria-label="Enter Pincode" aria-describedby="button-addon2">
                                <button class="btn bg-red text-white" type="button" id="button-addon2"
                                    style="z-index: 0;">Check Pincode</button>
                            </div>
                        </div>
                    </div> --}}
                    <br>
                    <div class="product-detail">
                        {!! $data[0]->short_desc !!}
                    </div>
                    <br>
                    <div class="size-option row">
                        <div class="col-6">
                            <h6>Size</h6>
                            <select class="form-select" aria-label="Default select example" id="size_id">
                                @foreach ($product_attr[$data[0]->id] as $sizelist)
                                    <option value="{{ $sizelist->size_id }}">{{ $sizelist->size }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row my-2">
                        <hr class="mb-3 w-70">
                        <div class="col-12 d-flex">
                            <input type="number" value="1" id="quantity" min="1" style="width: 10%;height: 100%;"
                                class="mx-2 text-center">
                            <button class="btn bg-red text-white" onclick="add_to_cart('{{ $data[0]->id }}');">Add To
                                Cart</button>
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
            <div class="row justify-content-center">
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
                            <div class="review-rating m-3">
                                <h4 class="m-2">Review</h4>
                                {{-- <div class="review-star my-3">
                                    <div class="star-rating row align-items-center">
                                        <div class="product-rating col-lg-2">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <span>(0)</span>
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
                                            <span>(0)</span>
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
                                            <span>(0)</span>
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
                                            <span>(0)</span>
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
                                            <span>(0)</span>
                                        </div>
                                        <div class="col-lg-10 p-0">
                                            <div class="progress" style="height: .5rem;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <!-- Set up your HTML -->
                                <div class="owl-carousel">
                                    <?php
                                    $hideratingform = '';
                                    ?>
                                    @foreach ($rating as $list)
                                        @if ($list->uid == session('USER_ID'))
                                            @php($hideratingform = 'd-none')
                                        @endif
                                        <div>
                                            <div class="card m-auto" style="width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title row align-items-center">
                                                        <div class="product-rating">
                                                            <?php
                                                            $fill = '-fill';
                                                            $j = $list->stars;
                                                            ?>
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($j < $i)
                                                                    @php($fill = '')
                                                                @endif
                                                                <i class='bi bi-star{{ $fill }}'></i>
                                                            @endfor
                                                        </div>
                                                    </h5>
                                                    <h6 class="card-subtitle mb-1 text-muted">{{ $list->name }}</h6>
                                                    <p class="card-text">{{ $list->comment }}</p>
                                                    <p class="text-end m-0">- <em>
                                                            {{ \Carbon\Carbon::parse($list->created_at)->isoFormat('MMM Do, YYYY') }}
                                                        </em></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="review-form border border-2 rounded mt-4 p-3 {{ $hideratingform }}">
                                    @if (!isset($rating[0]))
                                        <div class="first-review">
                                            <h4>Be the first to review “The Ethical Man Classic Purple Shirt”</h4>
                                            <p>Your email address will not be published. Required fields are marked *</p>
                                        </div>
                                    @endif
                                    <br>
                                    <div class='rating-widget'>
                                        <form class="row g-3" method="post"
                                            action="{{ url('/submit-rating/' . $data[0]->slug . '') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-12 my-1">
                                                <label for="inputEmail4" class="form-label">Your rating *</label>
                                                <div class='rating-stars'>
                                                    <input type="hidden" name="review-star" id="reviewstar">
                                                    <ul id='stars' class="m-0">
                                                        <li class='star' title='Poor' data-value='1'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='Fair' data-value='2'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='Good' data-value='3'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='Excellent' data-value='4'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                        <li class='star' title='WOW!!!' data-value='5'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-12 my-1">
                                                <label for="inputReviewText4" class="form-label">Your review *</label>
                                                <textarea class="form-control" name="review-comment" id="inputReviewText4" rows="3"></textarea>
                                            </div>
                                            <div class="col-12 my-1">
                                                <label for="reviewImg" class="form-label">Choose pictures (maxsize:
                                                    20000 kB, max files: 2)</label>
                                                <input class="form-control form-control-sm" name="review-img" id="reviewImg"
                                                    type="file">
                                            </div>
                                            @if (session('USER_ID') == '')
                                                <div class="col-md-6 my-1">
                                                    <label for="inputReviewName4" class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="review-name"
                                                        id="inputReviewName4">
                                                </div>
                                                <div class="col-md-6 my-1">
                                                    <label for="inputReviewEmail4" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="review-email"
                                                        id="inputReviewEmail4">
                                                </div>
                                            @endif
                                            <div class="col-12 my-2">
                                                <button type="submit" class="btn btn-sm  bg-red text-white">SUBMIT</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-3 related-products justify-content-center">
                <div class="col-10 mx-auto">
                    <h5 class="f-700 text-black mb-3">Related Products</h5>
                    <div class="row">
                        @foreach ($related_product as $list)
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="card border-0 m-auto" style="width: 90%;">
                                    <a href="{{ url('product/' . $list->slug . '') }}" class="product-img-link">
                                        <img src="{{ asset('storage/media/' . $list->image) }}" class="card-img-top"
                                            alt="...">
                                    </a>
                                    <div class="card-body px-1 py-2 product-detail">
                                        <span class="product-category">{{ $list->category_name }}</span>
                                        <a href="{{ url('product/' . $list->slug . '') }}">
                                            <h6 class="product-name">{{ $list->name }}</h6>
                                        </a>
                                        <span class="product-rating">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                        </span>
                                        <p class="product-pricing">₹{{ $related_prod_attr[$list->id][0]->price }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form id="addtocartform" method="post">
        @csrf
        <input type="hidden" id="size" name="size" />
        <input type="hidden" id="pid" name="pid" />
        <input type="hidden" id="qty" name="qty" />
    </form>
@endsection
@section('additional_js')
    <script src="{{ asset('user_assets/assets/plugins/OwlCarousel/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user_assets/assets/plugins/smooth/js/smoothproducts.min.js') }}">
    </script>
    <script type="text/javascript">
        /* wait for images to load */
        $(window).load(function() {
            $('.sp-wrap').smoothproducts();
        });
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                // center: true,
                autoplay: false,
                autoplayTimeout: 5000,
                autoplayHoverPause: false,
                loop: false,
                rewind: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function() {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function(e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function() {
                $(this).parent().children('li.star').each(function(e) {
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function() {
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                $('#reviewstar').val(ratingValue);
            });


        });
    </script>
@endsection
