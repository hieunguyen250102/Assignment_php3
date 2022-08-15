@extends('layout.client.main')
@section('title-page','Shop')
@section('title','Shop')
@section('content')
<style>
    input[type=range] {
        -webkit-appearance: none;
        margin: 20px 0;
    }

    input[type=range]:focus {
        outline: none;
    }

    input[type=range]::-webkit-slider-runnable-track {
        height: 4px;
        cursor: pointer;
        background: #03a9f4;
        border-radius: 25px;
    }

    input[type=range]::-webkit-slider-thumb {
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 0 4px 0 rgba(0, 0, 0, 1);
        cursor: pointer;
        -webkit-appearance: none;
        margin-top: -8px;
    }

    input[type=range]:focus::-webkit-slider-runnable-track {
        background: #03a9f4;
    }

    .range-wrap {
        position: relative;
    }

    .range-value {
        position: absolute;
        top: -50%;
    }

    .range-value span {
        width: 30px;
        height: 24px;
        line-height: 24px;
        text-align: center;
        background: #03a9f4;
        color: #fff;
        font-size: 12px;
        display: block;
        position: absolute;
        left: 50%;
        transform: translate(-50%, 0);
        border-radius: 6px;
    }

    .range-value span:before {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        border-top: 10px solid #03a9f4;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        margin-top: -1px;
    }
</style>
<div class="shop-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-3">
                <!-- Start Sidebar Area -->
                <div class="siderbar-section" data-aos="fade-up" data-aos-delay="0">

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">CATEGORIES</h6>
                        <div class="sidebar-content">
                            <ul class="sidebar-menu">
                                @foreach($categories as $category)
                                <li id="category_id" data-id="{{$category->id}}" onclick="searchFilter()">{{$category->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div> <!-- End Single Sidebar Widget -->

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">FILTER BY PRICE</h6>
                        <div class="sidebar-content">
                            <!-- <div id="slider-range"></div> -->
                            <div class="range-wrap">
                                <input type="range" id="rangeMin" name="minimum_price" min="1" max="1000" step="1" value="0">
                                <div class="filter-type-price">
                                    <!-- <label for="amount">Price range:</label> -->
                                    <div class="range-value" id="rangeMinV"></div>
                                </div>
                                <input type="range" id="rangeMax" name="max_price" min="1" max="1000" step="1" value="0">
                                <div class="filter-type-price">
                                    <!-- <label for="amount">Price range:</label> -->
                                    <div class="range-value" id="rangeMaxV"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <h6 class="sidebar-title">Tag products</h6>
                        <div class="sidebar-content">
                            <div class="tag-link">
                                <?php
                                $tag = [];
                                foreach ($products as $product) {
                                    $tag = explode(',', $product->tag);
                                };
                                foreach ($tag as $tg) { ?>
                                    <a href="{{'/tag/'. str_slug($tg)}}">{{$tg}}</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div> <!-- End Single Sidebar Widget -->

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <div class="sidebar-content">
                            <a href="product-details-default.html" class="sidebar-banner img-hover-zoom">
                                <img class="img-fluid" src="{{asset('/images/banner/side-banner.jpg')}}" alt="">
                            </a>
                        </div>
                    </div> <!-- End Single Sidebar Widget -->

                </div> <!-- End Sidebar Area -->
            </div>
            <div class="col-lg-9">
                <!-- Start Shop Product Sorting Section -->
                <div class="shop-sort-section">
                    <div class="container">
                        <div class="row">
                            <!-- Start Sort Wrapper Box -->
                            <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column" data-aos="fade-up" data-aos-delay="0">
                                <!-- Start Sort tab Button -->
                                <div class="sort-tablist d-flex align-items-center">
                                    <ul class="tablist nav sort-tab-btn">
                                        <li>
                                            <a class="nav-link active" data-bs-toggle="tab" href="#layout-3-grid">
                                                <img src="{{asset('/images/icons/bkg_grid.png')}}" alt="">
                                            </a>
                                        </li>
                                        <li><a class="nav-link" data-bs-toggle="tab" href="#layout-list"><img src="{{asset('/images/icons/bkg_list.png')}}" alt=""></a></li>
                                    </ul>

                                    <!-- Start Page Amount -->
                                    <div class="page-amount ml-2">
                                        <span>Showing 1–9 of 21 results</span>
                                    </div> <!-- End Page Amount -->
                                </div> <!-- End Sort tab Button -->

                                <!-- Start Sort Select Option -->
                                <div class="sort-select-list d-flex align-items-center">
                                    <input style="border: 1px solid #9a9a9a;padding:5px; width:100%" type="text" name="search" id="searchAjax" placeholder="Search">
                                </div>
                                <!-- End Sort Select Option -->



                            </div> <!-- Start Sort Wrapper Box -->
                        </div>
                    </div>
                </div> <!-- End Section Content -->

                <!-- Start Tab Wrapper -->
                <div class="sort-product-tab-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content tab-animate-zoom">
                                    <!-- Start Grid View Product -->
                                    <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                                        <div class="row" id="rowProduct">
                                            @foreach ($products as $product)
                                            <div class="col-xl-4 col-sm-6 col-12">
                                                <!-- Start Product Default Single Item -->
                                                <div class="product-default-single-item product-color--golden" data-aos="fade-up" data-aos-delay="0">
                                                    <div class="image-box">
                                                        <a href="{{route('shop.show',$product->id)}}" class="image-link">
                                                            <img src="{{asset('storage/images/product/' . $product->image)}}" alt="">
                                                            <img src="{{asset('storage/images/product/' . $product->image)}}" alt="">
                                                        </a>
                                                        <div class="action-link">
                                                            <div class="action-link-left">
                                                                <a onclick="addToCart(<?php echo $product->id ?>)" href="javascript:0" id="btn-add-to-cart" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add to Cart</a>
                                                                <!-- data-bs-toggle="modal" data-bs-target="#modalAddcart" -->
                                                            </div>
                                                            <div class="action-link-right">
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                                                <a href="wishlist.html"><i class="icon-heart"></i></a>
                                                                <a href="compare.html"><i class="icon-shuffle"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="content">
                                                        <div class="content-left">
                                                            <h6 class="title"><a href="{{route('shop.show',$product->id)}}">{{$product->name}}</a></h6>
                                                            <ul class="review-star">
                                                                <li class="fill"><i class="ion-android-star"></i>
                                                                </li>
                                                                <li class="fill"><i class="ion-android-star"></i>
                                                                </li>
                                                                <li class="fill"><i class="ion-android-star"></i>
                                                                </li>
                                                                <li class="fill"><i class="ion-android-star"></i>
                                                                </li>
                                                                <li class="empty"><i class="ion-android-star"></i>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="content-right">
                                                            <span class="price">$ {{$product->price}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Product Default Single Item -->
                                            </div>
                                            @endforeach
                                        </div>
                                    </div> <!-- End Grid View Product -->
                                    <!-- Start List View Product -->
                                    <div class="tab-pane sort-layout-single" id="layout-list">
                                        <div class="row" id="rowProduct">
                                            @foreach ($products as $product)
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single product-color--golden">
                                                    <a href="{{route('shop.show',$product->id)}}" class="product-list-img-link">
                                                        <img class="img-fluid" src="{{asset('storage/images/product/' . $product->image)}}" alt="">
                                                        <img class="img-fluid" src="{{asset('storage/images/product/' . $product->image)}}" alt="">
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="{{route('shop.show',$product->id)}}">{{$product->name}}</a></h5>
                                                        <ul class="review-star">
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="empty"><i class="ion-android-star"></i></li>
                                                        </ul>
                                                        @if($product->sale_price)
                                                        <span class="product-list-price"><del>{{$product->price}}</del>
                                                            {{$product->price}}</span>
                                                        @else
                                                        <span class="product-list-price">
                                                            {{$product->price}}</span>
                                                        @endif
                                                        <p>{{$product->summary}}</p>
                                                        <div class="product-action-icon-link-list">
                                                            <a onclick="addToCart(<?php echo $product->id ?>)" href="javascript:0" class="btn btn-lg btn-black-default-hover">Add to
                                                                cart</a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview" class="btn btn-lg btn-black-default-hover"><i class="icon-magnifier"></i></a>
                                                            <a href="wishlist.html" class="btn btn-lg btn-black-default-hover"><i class="icon-heart"></i></a>
                                                            <a href="compare.html" class="btn btn-lg btn-black-default-hover"><i class="icon-shuffle"></i></a>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            @endforeach
                                        </div>
                                    </div> <!-- End List View Product -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Tab Wrapper -->

                <!-- Start Pagination -->
                <table>
                    <tbody></tbody>
                </table>
                <div class="page-pagination text-center" data-aos="fade-up" data-aos-delay="0">
                    <ul>
                        <!-- <li><a class="active" href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="ion-ios-skipforward"></i></a></li> -->
                        {{ $products->links() }}
                    </ul>
                </div> <!-- End Pagination -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $('#searchAjax').on('keyup', function() {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '/search/product',
            data: {
                'search': $value,
            },
            success: function(data) {
                $('#rowProduct').html(data);
            }
        });
    })
    
    function searchFilter() {
        var minimum_price = $('#rangeMin').val();
        var maximum_price = $('#rangeMax').val();
        var category_id = $('#category_id').attr('data-id');
        console.log(category_id);
        console.log(minimum_price);
        console.log(maximum_price);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'get',
            url: '/filter/product',
            data: {
                'minimum_price': minimum_price,
                'maximum_price': maximum_price,
                'category_id': category_id,
            },
            success: function(data) {
                $('#rowProduct').html(data);
            }
        });
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
    }
    
    $('#rangeMin').on('change', function() {
        var minimum_price = $('#rangeMin').val();
        var maximum_price = $('#rangeMax').val();
        var category_id = $('#category_id').attr('data-id');
        console.log(category_id);
        console.log(minimum_price);
        console.log(maximum_price);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'get',
            url: '/filter/product',
            data: {
                'minimum_price': minimum_price,
                'maximum_price': maximum_price,
                'category_id': category_id,
            },
            success: function(data) {
                $('#rowProduct').html(data);
            }
        });
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
    });
    $('#rangeMax').on('change', function() {
        var minimum_price = $('#rangeMax').val();
        var maximum_price = $('#rangeMax').val();
        var category_id = $('#category_id').attr('data-id');
        console.log(category_id);
        console.log(minimum_price);
        console.log(maximum_price);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'get',
            url: '/filter/product',
            data: {
                'minimum_price': minimum_price,
                'maximum_price': maximum_price,
                'category_id': category_id,
            },
            success: function(data) {
                $('#rowProduct').html(data);
            }
        });
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
    });

    const
        rangeMin = document.getElementById('rangeMin'),
        rangeMax = document.getElementById('rangeMax'),
        rangeMinV = document.getElementById('rangeMinV'),
        rangeMaxV = document.getElementById('rangeMaxV'),
        setValueMin = () => {
            const
                newValue = Number((rangeMin.value - rangeMin.min) * 100 / (rangeMin.max - rangeMin.min)),
                newPosition = 10 - (newValue * 0.2);
            rangeMinV.innerHTML = `<span>${rangeMin.value}</span>`;
            rangeMinV.style.left = `calc(${newValue}% + (${newPosition}px))`;
        };
    setValueMax = () => {
        const
            newValue = Number((rangeMax.value - rangeMax.min) * 100 / (rangeMax.max - rangeMax.min)),
            newPosition = 10 - (newValue * 0.2);
        rangeMaxV.innerHTML = `<span>${rangeMax.value}</span>`;
        rangeMaxV.style.left = `calc(${newValue}% + (${newPosition}px))`;
    };
    document.addEventListener("DOMContentLoaded", setValueMin);
    document.addEventListener("DOMContentLoaded", setValueMax);
    rangeMin.addEventListener('input', setValueMin);
    rangeMax.addEventListener('input', setValueMax);
</script>
<!-- ...:::: End Shop Section:::... -->
@endsection