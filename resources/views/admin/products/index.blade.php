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
                    <div style="display: flex; justify-content:space-between">
                        <div>
                            <a href="{{route('products.create')}}"><button class="btn btn-primary mt-3">Create</button></a>
                        </div>
                        <div>
                            <input type="text" class="form-control" id="searchPro" name="search"></input>
                        </div>
                    </div>
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
                                <th scope="col">Image</th>
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
                                <td>
                                    <img width="100px" src="{{asset('storage/images/product/' . $product->image)}}" alt="">
                                </td>
                                @if($product->status == 0)
                                <td>
                                    <a href="{{route('admin.updateStatusProduct',['id'=>$product->id,'status'=>1])}}" class="btn btn-info"><i class="fa-solid fa-eye-slash"></i></a>
                                </td>
                                @else
                                <td>
                                    <a href="{{route('admin.updateStatusProduct',['id'=>$product->id,'status'=>0])}}" class="btn btn-light"><i class="fa-solid fa-eye"></i></a>
                                </td>
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
<script>
    $('.btnDelete').click(function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        $('#form-delete').attr('action', href);
        if (confirm('Are you sure?')) {
            $('#form-delete').submit();
        }
    })

    $('#searchPro').on('keyup', function() {
        var value = $(this).val();
        $.ajax({
            type: 'get',
            url: 'product-search/',
            data: {
                'search': value
            },
            success: function(data) {
                console.log(data);
                $('tbody').html(data);
            }
        });
    })
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
</script>
@endsection
@endsection