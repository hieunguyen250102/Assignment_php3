@extends('layout.client.main')
@section('title-page','Sign up')
@section('title','Sign up')
@section('title','Sign up')
@section('content')
<!-- ...:::: Start Customer Login Section :::... -->
<div class="customer-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <!--register area start-->
            <div class="col-lg-6 col-md-6">
                <div class="account_form register" data-aos="fade-up" data-aos-delay="200">
                    <h3>Register</h3>
                    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf()
                        <div class="default-form-box">
                            <label>Email address <span>*</span></label>
                            <input type="text" name="email">
                        </div>
                        <div class="default-form-box">
                            <label>First name <span>*</span></label>
                            <input type="text" name="firtsname">
                        </div>
                        <div class="default-form-box">
                            <label>Last name <span>*</span></label>
                            <input type="text" name="lastname">
                        </div>
                        <div class="default-form-box">
                            <label>Address <span>*</span></label>
                            <input type="text" name="address">
                        </div>
                        <div class="default-form-box">
                            <label>Birthday <span>*</span></label>
                            <input type="date" name="birthday">
                        </div>
                        <div class="default-form-box">
                            <label>Passwords <span>*</span></label>
                            <input type="password" name="password">
                        </div>
                        <div class="default-form-box">
                            <label>Phone number <span>*</span></label>
                            <input type="text" name="phone">
                        </div>
                        <div class="default-form-box">
                            <label>Avatar <span>*</span></label>
                            <input type="file" name="avatar">
                        </div>
                        <div class="login_submit">
                            <button class="btn btn-md btn-black-default-hover" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--register area end-->
            <div class="col-lg-3"></div>
        </div>
    </div>
</div> <!-- ...:::: End Customer Login Section :::... -->
@endsection