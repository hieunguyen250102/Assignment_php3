@extends('layout.client.main')
@section('title-page','My account')
@section('title','My account')
@section('title','My account')
@section('content')
<!-- ...:::: Start Account Dashboard Section:::... -->
<div class="account-dashboard">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <!-- Nav tabs -->
                <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                    <ul role="tablist" class="nav flex-column dashboard-list">
                        <!-- <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover active">Dashboard</a>
                        </li> -->
                        <li> <a href="#orders" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover">Orders</a></li>
                        <!-- <li><a href="#downloads" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover">Downloads</a></li>
                        <li><a href="#address" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover">Addresses</a></li> -->
                        <li><a href="#account-details" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover">Account details</a>
                        </li>
                        <li><a href="login.html" class="nav-link btn btn-block btn-md btn-black-default-hover">logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!-- Tab panes -->
                <!-- <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                    <div class="tab-pane fade show active" id="dashboard">
                        <h4>Dashboard </h4>
                        <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent
                                orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">Edit your password and account details.</a></p>
                    </div> -->
                <div class="tab-pane fade" id="orders" data-aos="fade-up" data-aos-delay="200">
                    <h4>Orders</h4>
                    @if(Session::has('success'))
                    <div class="alert alert-success w-100 ml-30">
                        <p class="text-success">{{Session::get('success')}}</p>
                    </div>
                    @endif
                    <div class="table_page table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{route('order-detail',$order->id)}}">{{$order->id}}</a></td>
                                    <td><a href="{{route('order-detail',$order->id)}}">{{$order->date}}</a></td>
                                    @if($order->status == 0)
                                    <td><a href="{{route('order-detail',$order->id)}}">Pending</a></td>
                                    @elseif ($order->status == 1)
                                    <td><a href="{{route('order-detail',$order->id)}}" class="text-warning">Confirmed</a></td>
                                    @elseif ($order->status == 2)
                                    <td><a href="{{route('order-detail',$order->id)}}" class="text-primary">On delivery</a></td>
                                    @elseif($order->status == 3)
                                    <td><a href="{{route('order-detail',$order->id)}}" class="text-success">Delivered</a></td>
                                    @else
                                    <td><a href="{{route('order-detail',$order->id)}}" class="text-danger">Canceled</a></td>
                                    @endif
                                    <td><a href="{{route('order-detail',$order->id)}}">${{number_format($order->totalAll)}}</a></td>
                                    @if($order->status !== 4)
                                    <td>
                                        <form action="{{route('order.updateStatus')}}" method="POST">
                                            <input type="hidden" name="status" value="4">
                                            <input type="hidden" name="id" value="{{$order->id}}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="view">Cancel</button>
                                        </form>
                                    </td>
                                    @else
                                    <td><a href="{{route('order-detail',$order->id)}}" class="view">View</a></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <div class="tab-pane fade" id="downloads">
                        <h4>Downloads</h4>
                        <div class="table_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Downloads</th>
                                        <th>Expires</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Shopnovilla - Free Real Estate PSD Template</td>
                                        <td>May 10, 2018</td>
                                        <td><span class="danger">Expired</span></td>
                                        <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                    </tr>
                                    <tr>
                                        <td>Organic - ecommerce html template</td>
                                        <td>Sep 11, 2018</td>
                                        <td>Never</td>
                                        <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="address">
                        <p>The following addresses will be used on the checkout page by default.</p>
                        <h5 class="billing-address">Billing address</h5>
                        <a href="#" class="view">Edit</a>
                        <p><strong>Bobby Jackson</strong></p>
                        <address>
                            Address: Your address goes here.
                        </address>
                    </div> -->
                <div class="tab-pane fade" id="account-details">
                    <h3>Account details </h3>
                    <div class="login">
                        <div class="login_form_container">
                            <div class="account_login_form">
                                <form action="#">
                                    <p>Already have an account? <a href="#">Log in instead!</a></p>
                                    <div class="input-radio">
                                        <span class="custom-radio"><input type="radio" value="1" name="id_gender"> Mr.</span>
                                        <span class="custom-radio"><input type="radio" value="1" name="id_gender"> Mrs.</span>
                                    </div> <br>
                                    <div class="default-form-box mb-20">
                                        <label>First Name</label>
                                        <input type="text" name="first-name">
                                    </div>
                                    <div class="default-form-box mb-20">
                                        <label>Last Name</label>
                                        <input type="text" name="last-name">
                                    </div>
                                    <div class="default-form-box mb-20">
                                        <label>Email</label>
                                        <input type="text" name="email-name">
                                    </div>
                                    <div class="default-form-box mb-20">
                                        <label>Password</label>
                                        <input type="password" name="user-password">
                                    </div>
                                    <div class="default-form-box mb-20">
                                        <label>Birthdate</label>
                                        <input type="date" name="birthday">
                                    </div>
                                    <span class="example">
                                        (E.g.: 05/31/1970)
                                    </span>
                                    <br>
                                    <label class="checkbox-default" for="offer">
                                        <input type="checkbox" id="offer">
                                        <span>Receive offers from our partners</span>
                                    </label>
                                    <br>
                                    <label class="checkbox-default checkbox-default-more-text" for="newsletter">
                                        <input type="checkbox" id="newsletter">
                                        <span>Sign up for our newsletter<br><em>You may unsubscribe at any
                                                moment. For that purpose, please find our contact info in the
                                                legal notice.</em></span>
                                    </label>
                                    <div class="save_button mt-3">
                                        <button class="btn btn-md btn-black-default-hover" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Account Dashboard Section:::... -->
@endsection