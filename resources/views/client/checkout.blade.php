@extends('layout.client.main')
@section('title-page','Checkout')
@section('title','Checkout')
@section('title','Checkout')
@section('content')
<!-- ...:::: Start Checkout Section:::... -->
<div class="checkout-section">
    <div class="container">
        <div class="row">
            <!-- User Quick Action Form -->
            <!-- <div class="col-12">
                <div class="user-actions accordion" data-aos="fade-up" data-aos-delay="0">
                    <h3>
                        <i class="fa fa-file-o" aria-hidden="true"></i>
                        Returning customer?
                        <a class="Returning" href="#" data-bs-toggle="collapse" data-bs-target="#checkout_login" aria-expanded="true">Click here to login</a>
                    </h3>
                    <div id="checkout_login" class="collapse" data-parent="#checkout_login">
                        <div class="checkout_info">
                            <p>If you have shopped with us before, please enter your details in the boxes below. If
                                you are a new customer please proceed to the Billing &amp; Shipping section.</p>
                            <form action="#">
                                <div class="form_group default-form-box">
                                    <label>Username or email <span>*</span></label>
                                    <input type="text">
                                </div>
                                <div class="form_group default-form-box">
                                    <label>Password <span>*</span></label>
                                    <input type="password">
                                </div>
                                <div class="form_group group_3 default-form-box">
                                    <button class="btn btn-md btn-black-default-hover" type="submit">Login</button>
                                    <label class="checkbox-default">
                                        <input type="checkbox">
                                        <span>Remember me</span>
                                    </label>
                                </div>
                                <a href="#">Lost your password?</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="user-actions accordion" data-aos="fade-up" data-aos-delay="200">
                    <h3>
                        <i class="fa fa-file-o" aria-hidden="true"></i>
                        Returning customer?
                        <a class="Returning" href="#" data-bs-toggle="collapse" data-bs-target="#checkout_coupon" aria-expanded="true">Click here to enter your code</a>

                    </h3>
                    <div id="checkout_coupon" class="collapse checkout_coupon" data-parent="#checkout_coupon">
                        <div class="checkout_info">
                            <form action="#">
                                <input placeholder="Coupon code" type="text">
                                <button class="btn btn-md btn-black-default-hover" type="submit">Apply
                                    coupon</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- User Quick Action Form -->
        </div>
        <!-- Start User Details Checkout Form -->
        <div class="checkout_form" data-aos="fade-up" data-aos-delay="400">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form action="{{route('order.store')}}" method="POST">
                        <input type="hidden" name="user_id" value="{{$user_id}}">
                        <input type="hidden" name="coupon" value="null">
                        <input type="hidden" name="totalAll" value="{{$totalAll}}">
                        <input type="hidden" name="status" value="0">
                        @csrf
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="default-form-box">
                                    <label>Full Name <span>*</span></label>
                                    <input type="text" name="name">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="default-form-box">
                                    <label>Email</label>
                                    <input type="text" name="email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="default-form-box">
                                    <label>Phone<span>*</span></label>
                                    <input type="text" name="phone">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="default-form-box">
                                    <label>Address<span>*</span></label>
                                    <input type="text" name="address">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="order-notes">
                                    <label for="order_note">Order Notes</label>
                                    <textarea id="order_note" placeholder="Notes about your order, e.g. special notes for delivery." name="order_note"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="payment_method">
                            <div class="order_button pt-3">
                                <button class="btn btn-md btn-black-default-hover" type="submit">Proceed to
                                    PayPal</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h3>Your order</h3>
                    <div class="order_table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Total</th>
                                    <td>${{number_format($totalAll)}}</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td><strong>$35</strong></td>
                                </tr>
                                <tr class="order_total">
                                    <th>Order Total</th>
                                    <td><strong>${{number_format($totalAll + 35)}}</strong></td>
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Start User Details Checkout Form -->
</div>
</div><!-- ...:::: End Checkout Section:::... -->
@endsection