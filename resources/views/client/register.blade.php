@extends('layout.client.main')
@section('title-page','Sign up')
@section('title','Sign up')
@section('title','Sign up')
@section('content')
<!-- ...:::: Start Customer Login Section :::... -->
<div class="customer-login">
@if($errors->any())
{{($errors)}}
@endif
<div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <!--register area start-->
            <div class="col-lg-6 col-md-6">
                <div class="account_form register" data-aos="fade-up" data-aos-delay="200">
                    <h3>Register</h3>
                    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf()
                        <div class="default-form-box">
                            <label>Email address <span>*</span></label>
                            <input type="text" name="email" style="border:1px solid <?php echo ($errors->first('email') ? 'red' : '#ededed') ?>" placeholder="{{$errors->first('email')}}" value="{{old('email')}}">
                        </div>
                        <div class="default-form-box">
                            <label>First name <span>*</span></label>
                            <input type="text" name="firtsname" style="border:1px solid <?php echo ($errors->first('firtsname') ? 'red' : '#ededed') ?>" placeholder="{{$errors->first('firtsname')}}" value="{{old('firtsname')}}">
                        </div>
                        <div class="default-form-box">
                            <label>Last name <span>*</span></label>
                            <input type="text" name="lastname" style="border:1px solid <?php echo ($errors->first('lastname') ? 'red' : '#ededed') ?>" placeholder="{{$errors->first('lastname')}}" value="{{old('lastname')}}">
                        </div>
                        <div class="default-form-box">
                            <label>Address <span>*</span></label>
                            <input type="text" name="address" style="border:1px solid <?php echo ($errors->first('address') ? 'red' : '#ededed') ?>" placeholder="{{$errors->first('address')}}" value="{{old('address')}}">
                        </div>
                        <div class="default-form-box">
                            <label>Birthday <span>*</span></label>
                            <input type="date" name="birthday" style="border:1px solid <?php echo ($errors->first('birthday') ? 'red' : '#ededed') ?>" placeholder="{{$errors->first('birthday')}}" value="{{old('birthday')}}">
                        </div>
                        <div class="default-form-box">
                            <label>Passwords <span>*</span></label>
                            <input type="password" name="password" style="border:1px solid <?php echo ($errors->first('password') ? 'red' : '#ededed') ?>" placeholder="{{$errors->first('password')}}" value="{{old('password')}}">
                        </div>
                        <div class="default-form-box">
                            <label>Phone number <span>*</span></label>
                            <input type="text" name="phone" style="border:1px solid <?php echo ($errors->first('phone') ? 'red' : '#ededed') ?>" placeholder="{{$errors->first('phone')}}" value="{{old('phone')}}">
                        </div>
                        <div class="default-form-box">
                            <label>Avatar <span>*</span></label>
                            <input type="file" name="avatar" accept="image/*" onchange="loadFile(event)" src="{{old('avatar')}}">
                            <img width="100px" id="output" />
                        </div>
                        <div class="login_submit">
                            <button class="btn btn-md btn-black-default-hover" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--register area end-->
            <div class="col-lg-3"></div>
        </div>
    </div>
</div> <!-- ...:::: End Customer Login Section :::... -->
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    }
</script>
@endsection