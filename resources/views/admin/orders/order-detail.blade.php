@extends('layout.admin.main')
@section('title-page', 'List orders')
@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Order Detail</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3">
                                <ul>
                                    <li>Name: <span class="font-primary first_name_0">{{$order->name}}</span></li>
                                    <li>
                                        Date: <span class="font-primary"> {{$order->date}}</span>
                                    </li>
                                    <li>Address: <span class="font-primary">{{$order->adđress}}</span></li>
                                    <li>Mobile: <span class="font-primary mobile_num_0">+{{$order->phone}}</span></li>
                                    <li>Email Address: <span class="font-primary email_add_0">{{$order->email}}</span></li>
                                </ul>
                            </div>
                            <div class="order-history table-responsive wishlist">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Qty</th>
                                            <th>Unit Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderDetail as $od)
                                        <tr>
                                            <td>{{$od->id}}</td>
                                            <td>
                                                <div class="product-name">
                                                    <a href="#">
                                                        <h6>{{$od->oddNamePrd}}</h6>
                                                    </a>
                                                </div>
                                            </td>
                                            <td><img class="img-fluid img-40" src="{{asset('storage/images/product/' . $od->image)}}" alt=""></td>
                                            <td>${{number_format($od->oddPricePrd)}}</td>
                                            <td>
                                                <span>{{$od->oddQuantityPrd}}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $('.btnDelete').click(function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        $('#form-delete').attr('action', href);
        if (confirm('Are you sure?')) {
            $('#form-delete').submit();
        }
    })

    if ($('#solidAll').is(":checked")) {
        console.log($('#solid').val());
    }
</script>
@endsection
@endsection