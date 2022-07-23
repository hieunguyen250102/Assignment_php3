@extends('layout.admin.main')
@section('title-page', 'List products')
@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>List products</h5>
                    <a href="{{route('products.create')}}"><button class="btn btn-primary mt-3">Create</button></a>
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
                                <th scope="col">Name product</th>
                                <th scope="col">Status</th>
                                <th scope="col" colspan="2">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-dark">
                                        <input id="solid" type="checkbox" value="{{$product->id}}">
                                        <label for="solid"></label>
                                    </div>
                                </td>
                                <th scope="row">{{$product->id}}</th>
                                <td>{{$product->name}}</td>
                                @if($product->status == 0)
                                <td><button class="btn btn-secondary"><i class="fa fa-eye"></i></button></td>
                                @else
                                <td><button class="btn btn-secondary"><i class="fa fa-eye-slash"></i></button></td>
                                @endif
                                <td>
                                    <a href="{{route('products.edit',['product' => $product->id])}}">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('products.destroy',['product' => $product->id])}}" class="btn btn-danger btnDelete">Delete</a>
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