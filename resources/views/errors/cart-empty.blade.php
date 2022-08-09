@extends('layout.client.main')
@section('title-page','Cart empty')
@section('title','Cart empty')
@section('title','Cart empty')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
<!-- ...:::: Start Error Section :::... -->
<div class="error-section">
    <div class="container">
        <div class="row">
            <div class="error-form">
                <h1 class="big-title" data-aos="fade-up" data-aos-delay="0"><img width="200px" src="https://cdn-icons-png.flaticon.com/512/34/34568.png" alt=""></h1>
                <h4 class="sub-title" data-aos="fade-up" data-aos-delay="200">Opps! YOUR CART IS EMPTY</h4>
                <!-- <p data-aos="fade-up" data-aos-delay="400">Sorry but the page you are looking for does not exist,
                    have been<br> removed, name changed or is temporarily unavailable.</p>
                <div class="row">
                    <div class="col-10 offset-1 col-md-4 offset-md-4">
                        <div class="default-search-style d-flex" data-aos="fade-up" data-aos-delay="600">
                            <input class="default-search-style-input-box" type="search" placeholder="Search..." required>
                            <button class="default-search-style-input-btn" type="submit"><i class="fa fa-search"></i></button>
                        </div> -->
                        <a href="users/login" class="btn btn-md btn-black-default-hover mt-7" data-aos="fade-up" data-aos-delay="800">Login to shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Error Section :::... -->
@endsection