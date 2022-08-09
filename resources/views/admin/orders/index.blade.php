@extends('layout.admin.main')
@section('title-page', 'List orders')
@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>List orders</h5>
                    <a href="{{route('orders.create')}}"><button class="btn btn-primary mt-3">Create</button></a>
                </div>
                @if(Session::has('alert'))
                <div class="alert alert-primary w-50 ml-30">
                    <p class="font-light">{{Session::get('alert')}}</p>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-border-vertical" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>
                                    <div class="checkbox checkbox-dark">
                                        <input id="solidAll" type="checkbox">
                                        <label for="solid"></label>
                                    </div>
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col" colspan="3">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-dark">
                                        <input id="solid" type="checkbox" value="{{$order->id}}">
                                        <label for="solid"></label>
                                    </div>
                                </td>
                                <th scope="row">{{$order->id}}</th>
                                <td>{{$order->date}}</td>
                                <td>${{number_format($order->totalAll)}}</td>
                                @if($order->status == 0)
                                <td><span>Pending</span></td>
                                @elseif ($order->status == 1)
                                <td><span class="text-warning">Confirmed</span></td>
                                @elseif ($order->status == 2)
                                <td><span class="text-primary">On delivery</span></td>
                                @elseif($order->status == 3)
                                <td><span class="text-success">Delivered</span></td>
                                @else
                                <td><span class="text-danger">Canceled</span></td>
                                @endif
                                <td>
                                    <a href="{{route('admin.order-detail',$order->id)}}">
                                        <button class="btn btn-success">View</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('orders.edit',['order' => $order->id])}}">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('orders.destroy',['order' => $order->id])}}" class="btn btn-danger btnDelete">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form action="" method="POST" id="form-delete">
                        {{ method_field('DELETE') }}
                        {!! csrf_field() !!}
                    </form>
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