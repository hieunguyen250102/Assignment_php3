@extends('layout.client.main')
@section('title-page','404 Not found')
@section('title','404 Not found')
@section('title','404 Not found')
@section('content')
<!-- ...:::: Start Error Section :::... -->
<div class="error-section">
    <div class="container">
        <div class="row">
            <div class="error-form">
                <h1 class="big-title" data-aos="fade-up" data-aos-delay="0">404</h1>
                <h4 class="sub-title" data-aos="fade-up" data-aos-delay="200">Opps! PAGE NOT BE FOUND</h4>
                <p data-aos="fade-up" data-aos-delay="400">Sorry but the page you are looking for does not exist,
                    have been<br> removed, name changed or is temporarily unavailable.</p>
                <div class="row">
                    <div class="col-10 offset-1 col-md-4 offset-md-4">
                        <div class="default-search-style d-flex" data-aos="fade-up" data-aos-delay="600">
                            <input class="default-search-style-input-box" type="search" placeholder="Search..." required>
                            <button class="default-search-style-input-btn" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                        <a href="/" class="btn btn-md btn-black-default-hover mt-7" data-aos="fade-up" data-aos-delay="800">Back to home page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Error Section :::... -->
@endsection