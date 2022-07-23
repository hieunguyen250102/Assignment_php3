@extends('layout.admin.main')
@section('title-page', 'Create new category')
@section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Create new category</h5>
                        <!-- <span>Using the <a href="#">card</a> component, you can extend the default collapse behavior to create an accordion.</span> -->
                    </div>
                    <div class="card-body">
                        <form action="{{route('categories.store')}}" method="POST" class="theme-form">
                            {!! csrf_field() !!}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Name category</label>
                                <input name="name" class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Enter name category">
                            </div>
                            <fieldset class="mb-3">
                                <div class="row">
                                    <label class="col-form-label col-sm-3 pt-0">Status</label>
                                    <div class="col-sm-9">
                                        <div class="form-check radio radio-primary">
                                            <input checked class="form-check-input" id="radio11" type="radio" name="status" value="0">
                                            <label class="form-check-label" for="radio11">Show</label>
                                        </div>
                                        <div class="form-check radio radio-primary">
                                            <input class="form-check-input" id="radio22" type="radio" name="status" value="1">
                                            <label class="form-check-label" for="radio22">Hidden</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
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
</div>
@endsection