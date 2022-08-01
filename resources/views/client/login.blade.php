@extends('layout.client.main')
@section('title-page','Sign in')
@section('title','Sign in')
@section('title','Sign in')
@section('content')
<!-- ...:::: Start Customer Login Section :::... -->
<div class="customer-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <!--login area start-->
            <div class="col-lg-6 col-md-6">
                <div class="account_form" data-aos="fade-up" data-aos-delay="0">
                    <h3>Login</h3>
                    <form action="{{route('users.login')}}" method="POST">
                        @csrf
                        <div class="default-form-box">
                            <label>Email <span>*</span></label>
                            <input type="text" name="email" placeholder="{{$errors->first('email')}}" style=" border:1px solid <?php echo ($errors->first('email') ? 'red' : '#ededed') ?>">
                        </div>
                        <div class=" default-form-box">
                            <label>Passwords <span>*</span></label>
                            <input type="password" name="password" placeholder="{{$errors->first('password')}}"  style="border:1px solid <?php echo ($errors->first('password') ? 'red' : '#ededed') ?>">
                        </div>
                        <div class="login_submit">
                            <button class="btn btn-md btn-black-default-hover mb-4" type="submit">login</button>
                            <label class="checkbox-default mb-4" for="offer">
                                <input type="checkbox" id="offer">
                                <span>Remember me</span>
                            </label>
                            <div style="display: flex;justify-content:space-between">
                                <div>
                                    <a href="#">Lost your password?</a>
                                </div>
                                <div>
                                    <a href="{{route('users.create')}}">Don't have account? Sign up now</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--login area start-->
            <div class="col-lg-3"></div>
            <!--register area start-->
            <!-- <div class="col-lg-6 col-md-6">
                <div class="account_form register" data-aos="fade-up" data-aos-delay="200">
                    <h3>Register</h3>
                    <form action="{{route('users.create')}}" method="POST">
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
            </div> -->
            <!--register area end-->
        </div>
    </div>
</div> <!-- ...:::: End Customer Login Section :::... -->
@endsection