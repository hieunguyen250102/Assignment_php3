@extends('layout.client.main')
@section('title-page','Compare')
@section('title','Compare')
@section('title','Compare')
@section('content')
<!-- ...:::: Start Compare Section:::... -->
<div class="compare-section">
    <!-- Start Cart Table -->
    <div class="compare-table-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="table_page table-responsive compare-table">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td class="first-column">Product</td>
                                        <td class="product-image-title">
                                            <a href="product-details-default.html" class="image"><img src="{{asset('/images/product/default/home-1/default-1.jpg')}}" alt="Compare Product"></a>
                                            <a href="shop-grid-sidebar-left.html" class="category">Furniture</a>
                                            <a href="product-details-default.html" class="title">Rinosin title</a>
                                        </td>
                                        <td class="product-image-title">
                                            <a href="product-details-default.html" class="image"><img src="{{asset('/images/product/default/home-1/default-2.jpg')}}" alt="Compare Product"></a>
                                            <a href="shop-grid-sidebar-left.html" class="category">Furniture</a>
                                            <a href="product-details-default.html" class="title">Macro title</a>
                                        </td>
                                        <td class="product-image-title">
                                            <a href="product-details-default.html" class="image"><img src="{{asset('/images/product/default/home-1/default-3.jpg')}}" alt="Compare Product"></a>
                                            <a href="shop-grid-sidebar-left.html" class="category">Furniture</a>
                                            <a href="product-details-default.html" class="title">Oakley title</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Description</td>
                                        <td class="pro-desc">
                                            <p>Eye glasses are very important for thos whos have some difficult in
                                                their eye to see every hing clearly and perfectly</p>
                                        </td>
                                        <td class="pro-desc">
                                            <p>Eye glasses are very important for thos whos have some difficult in
                                                their eye to see every hing clearly and perfectly</p>
                                        </td>
                                        <td class="pro-desc">
                                            <p>Eye glasses are very important for thos whos have some difficult in
                                                their eye to see every hing clearly and perfectly</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Price</td>
                                        <td class="pro-price">$295</td>
                                        <td class="pro-price">$275</td>
                                        <td class="pro-price">$395</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Color</td>
                                        <td class="pro-color">Black</td>
                                        <td class="pro-color">Black</td>
                                        <td class="pro-color">Black</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Stock</td>
                                        <td class="pro-stock">In Stock</td>
                                        <td class="pro-stock">In Stock</td>
                                        <td class="pro-stock">In Stock</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Add to cart</td>
                                        <td class="pro-addtocart"><a href="#" class="btn btn-md btn-golden" data-bs-toggle="modal" data-bs-target="#modalAddcart"><span>ADD TO
                                                    CART</span></a></td>
                                        <td class="pro-addtocart"><a href="#" class="btn btn-md btn-golden" data-bs-toggle="modal" data-bs-target="#modalAddcart"><span>ADD TO
                                                    CART</span></a></td>
                                        <td class="pro-addtocart"><a href="#" class="btn btn-md btn-golden" data-bs-toggle="modal" data-bs-target="#modalAddcart"><span>ADD TO
                                                    CART</span></a></td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Delete</td>
                                        <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                        <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                        <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Rating</td>
                                        <td class="pro-ratting">
                                            <div class="product-review">
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-empty"><i class="fa fa-star"></i></span>
                                            </div>
                                        </td>
                                        <td class="pro-ratting">
                                            <div class="product-review">
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-empty"><i class="fa fa-star"></i></span>
                                            </div>
                                        </td>
                                        <td class="pro-ratting">
                                            <div class="product-review">
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                                <span class="review-empty"><i class="fa fa-star"></i></span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Cart Table -->
</div> <!-- ...:::: Start Compare Section:::... -->
@endsection