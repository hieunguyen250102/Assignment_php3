@extends('layout.client.main')
@section('title-page','Login')
@section('title','Login')
@section('title','Login')
@section('content')
<!-- ...:::: Start Customer Login Section :::... -->
<div class="customer-login">
    <div class="container">
        <div class="row">
            <!--login area start-->
            <div class="col-lg-6 col-md-6">
                <div class="account_form" data-aos="fade-up" data-aos-delay="0">
                    <h3>login</h3>
                    <form action="#" method="POST">
                        <div class="default-form-box">
                            <label>Username or email <span>*</span></label>
                            <input type="text">
                        </div>
                        <div class="default-form-box">
                            <label>Passwords <span>*</span></label>
                            <input type="password">
                        </div>
                        <div class="login_submit">
                            <button class="btn btn-md btn-black-default-hover mb-4" type="submit">login</button>
                            <label class="checkbox-default mb-4" for="offer">
                                <input type="checkbox" id="offer">
                                <span>Remember me</span>
                            </label>
                            <a href="#">Lost your password?</a>

                        </div>
                    </form>
                </div>
            </div>
            <!--login area start-->

            <!--register area start-->
            <div class="col-lg-6 col-md-6">
                <div class="account_form register" data-aos="fade-up" data-aos-delay="200">
                    <h3>Register</h3>
                    <form action="#">
                        <div class="default-form-box">
                            <label>Email address <span>*</span></label>
                            <input type="text">
                        </div>
                        <div class="default-form-box">
                            <label>Passwords <span>*</span></label>
                            <input type="password">
                        </div>
                        <div class="login_submit">
                            <button class="btn btn-md btn-black-default-hover" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--register area end-->
        </div>
    </div>
</div> <!-- ...:::: End Customer Login Section :::... -->
@endsection