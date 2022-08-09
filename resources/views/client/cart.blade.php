@extends('layout.client.main')
@section('title-page','Cart')
@section('title','Cart')
@section('title','Cart')
@section('content')
<!-- ...:::: Start Cart Section:::... -->
<div class="cart-section">
    <!-- Start Cart Table -->
    <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <table>
                                <!-- Start Cart Table Head -->
                                <thead>
                                    <tr>
                                        <th class="product_remove">Delete</th>
                                        <th class="product_thumb">Image</th>
                                        <th class="product_name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product_quantity">Quantity</th>
                                        <th class="product_total">Total</th>
                                    </tr>
                                </thead> <!-- End Cart Table Head -->
                                <tbody>
                                    <!-- Start Cart Single Item-->
                                    @foreach($carts as $details)
                                    <?php
                                    $total = 0;
                                    $total += $details['price'] * $details['quantity'];
                                    // $totalFlag = ($total += $total);
                                    ?>
                                    <tr>
                                        <form action="{{route('cart.destroy',$details->id)}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <td class="product_remove"><button type="submit" style="cursor:pointer" class="fa fa-trash-o"></button>
                                            </td>
                                        </form>
                                        <td class="product_thumb"><a href="product-details-default.html"><img src="{{asset('storage/images/product/' . $details['image'])}}" alt=""></a></td>
                                        <td class="product_name"><a href="">{{ $details['name'] }}</a></td>
                                        <td class="product-price">${{ number_format($details['price']) }}</td>
                                        <td class="product_quantity update-cart quantity"><label>Quantity</label> <input min="1" max="100" value="{{ $details['quantity'] }}" type="number" name="quantity"></td>
                                        <td class="product_total">${{number_format($total)}}</td>
                                        <p hidden>{{$totalAll+=$details['price'] * $details['quantity']}}</p>
                                    </tr>
                                    @endforeach
                                    <!-- End Cart Single Item-->
                                </tbody>
                            </table>
                        </div>
                        <div class="cart_submit">
                            <button class="btn btn-md btn-golden" type="submit">update cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Cart Table -->

    <!-- Start Coupon Start -->
    <div class="coupon_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code left" data-aos="fade-up" data-aos-delay="200">
                        <h3>Coupon</h3>
                        <div class="coupon_inner">
                            <p>Enter your coupon code if you have one.</p>
                            <input class="mb-2" placeholder="Coupon code" type="text">
                            <button type="submit" class="btn btn-md btn-golden">Apply coupon</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
                        <h3>Cart Totals</h3>
                        <div class="coupon_inner">
                            <div class="cart_subtotal">
                                <p>Subtotal</p>
                                <p class="cart_amount">${{number_format($totalAll)}}</p>
                            </div>
                            <div class="checkout_btn">
                                <form action="{{route('order.index')}}" method="POST">
                                    @method('GET')
                                    <input type="hidden" name="totalAll" value="{{$totalAll}}">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="carts" value="{{$carts}}">
                                    @csrf
                                    <button class="btn btn-md btn-golden">Proceed to Checkout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Coupon Start -->
</div> <!-- ...:::: End Cart Section:::... -->
<!-- Start Footer Section -->
@endsection