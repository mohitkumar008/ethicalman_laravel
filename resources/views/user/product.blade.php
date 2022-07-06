@extends('user/layout')
@section('page_title', 'Products | The Ethical Man')
@section('additional_css')
@endsection

@section('content-wrapper')
    <section class="product-page pad50">
        <div class="container">
            <div class="row py-5 px-4">
                <div class="col-6">
                    <a href="/">Home</a><span class="text-red"> / </span><span class="text-red">Product</span>
                </div>
                <div class="col-3 offset-3 text-end">
                    <select class="form-select" aria-label="Default select example" id="sortBy" onchange="sortBy()">
                        <option @if (isset($_GET['sort']) && ($_GET['sort'] == '' || $_GET['sort'] == 'default')) {{ 'selected' }} @endif value="default">Sort by default
                        </option>
                        <option @if (isset($_GET['sort']) && $_GET['sort'] == 'latest') {{ 'selected' }} @endif value="latest">Sort by latest
                        </option>
                        <option @if (isset($_GET['sort']) && $_GET['sort'] == 'a-z') {{ 'selected' }} @endif value="a-z">Sort by A-Z
                        </option>
                        <option @if (isset($_GET['sort']) && $_GET['sort'] == 'z-a') {{ 'selected' }} @endif value="z-a">Sort by Z-A
                        </option>
                        <option @if (isset($_GET['sort']) && $_GET['sort'] == 'low_to_high') {{ 'selected' }} @endif value="low_to_high">Sort by
                            price : low to high</option>
                        <option @if (isset($_GET['sort']) && $_GET['sort'] == 'high_to_low') {{ 'selected' }} @endif value="high_to_low">Sort by
                            price : high to low</option>
                        {{-- <option value="avg_rating">Sort by average rating</option> --}}
                    </select>
                </div>
            </div>
            <div class="row product-list">
                @foreach ($product as $list)
                    <div class="col-lg-4 col-md-3 col-sm-6">
                        <div class="card border-0" style="width: 90%;">
                            <a href="product/{{ $list->slug }}" class="product-img-link">
                                <img src="{{ asset('storage/media/' . $list->image) }}" class="card-img-top"
                                    alt="...">
                            </a>
                            <div class="card-body px-1 py-2 product-detail">
                                <span class="product-category">{{ $list->category_name }}</span>
                                <a href="product/{{ $list->slug }}">
                                    <h6 class="product-name">{{ $list->name }}</h6>
                                </a>
                                <span class="product-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                </span>
                                <p class="product-pricing">₹{{ $prod_attr[$list->id][0]->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <form id="filterProduct">
        <input type="hidden" name="sort" id="sort">
    </form>
@endsection
@section('additional_js')
@endsection
