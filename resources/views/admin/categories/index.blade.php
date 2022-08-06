@extends('layout.admin.main')
@section('title-page', 'List categories')
@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>List categories</h5>
                    <a href="/admin/categories/create"><button class="btn btn-primary mt-3">Create</button></a>
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
                                <th scope="col">Name category</th>
                                <th scope="col">Status</th>
                                <th scope="col" colspan="2">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>
                                    <div class="checkbox checkbox-dark">
                                        <input id="solid{{$category->id}}" type="checkbox">
                                        <label for="solid{{$category->id}}"></label>
                                    </div>
                                </td>
                                <th scope="row">{{$category->id}}</th>
                                <td>{{$category->name}}</td>
                                @if($category->status == 0)
                                <td>
                                    <a href="{{route('admin.updateStatusCategory',['id'=>$category->id,'status'=>1])}}" class="btn btn-info"><i class="fa-solid fa-eye-slash"></i></a>
                                </td>
                                @else
                                <td>
                                    <a href="{{route('admin.updateStatusCategory',['id'=>$category->id,'status'=>0])}}" class="btn btn-light"><i class="fa-solid fa-eye"></i></a>
                                </td>
                                @endif
                                <td>
                                    <a href="{{route('categories.edit',['category' => $category->id])}}">
                                        <button class="btn btn-warning">Edit</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('categories.destroy',['category' => $category->id])}}" class="btn btn-danger btnDelete">Delete</a>
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