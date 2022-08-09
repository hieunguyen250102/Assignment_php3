@extends('layout.admin.main')
@section('title-page', 'Edit category')
@section('content')

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Edit order</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('orders.update',$order->id)}}" method="POST" class="theme-form" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$order->id}}">
                            <input type="hidden" name="user_id" value="{{$order->user_id}}">
                            <input type="hidden" name="coupon" value="{{$order->coupon}}">
                            <input type="hidden" name="date" value="{{$order->date}}">
                            <input type="hidden" name="totalAll" value="{{$order->totalAll}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Name customer</label>
                                <input value="{{$order->name}}" name="name" class="form-control <?php echo ($errors->first('name') ? 'is-invalid' : ' ') ?>" id="exampleInputEmail1" type="text" placeholder="Enter name order" value="{{old('name')}}">
                                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Phone number</label>
                                <input value="{{$order->phone}}" name="phone" class="form-control <?php echo ($errors->first('phone') ? 'is-invalid' : ' ') ?>" id="exampleInputEmail1" type="text" placeholder="Enter phone order" value="{{old('phone')}}">
                                <div class="invalid-feedback">{{$errors->first('phone')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Address</label>
                                <input value="{{$order->address}}" name="address" class="form-control <?php echo ($errors->first('address') ? 'is-invalid' : ' ') ?>" type="text">
                                <div class="invalid-feedback">{{$errors->first('address')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Email</label>
                                <input value="{{$order->email}}" name="email" class="form-control <?php echo ($errors->first('email') ? 'is-invalid' : ' ') ?>" type="email">
                                <div class="invalid-feedback">{{$errors->first('email')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Note</label>
                                <textarea value="{{$order->order_note}}" name="order_note" class="form-control <?php echo ($errors->first('order_note') ? 'is-invalid' : ' ') ?>" id="order_note">{{$order->order_note}}</textarea>
                                <script>
                                    CKEDITOR.replace('order_note');
                                </script>
                                <div class="invalid-feedback">{{$errors->first('order_note')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label col-sm-3 pt-0" for="exampleFormControlSelect9">Status order</label>
                                <select name="status" class="form-select digits <?php echo ($errors->first('status') ? 'is-invalid' : ' ') ?>" id="exampleFormControlSelect9">
                                    <option <?php echo $order->status == 0 ? 'selected' : '' ?> value="0">Pending</option>
                                    <option <?php echo $order->status == 1 ? 'selected' : '' ?> value="1">Confirmed</option>
                                    <option <?php echo $order->status == 2 ? 'selected' : '' ?> value="2">On delivery</option>
                                    <option <?php echo $order->status == 3 ? 'selected' : '' ?> value="3">Delivered</option>
                                    <option <?php echo $order->status == 4 ? 'selected' : '' ?> value="4">Canceled</option>
                                </select>
                                <div class=" invalid-feedback">{{$errors->first('status')}}
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection