@extends('layout.admin.main')
@section('title-page', 'Edit category')
@section('content')
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
<style>
    .wrapper {
        width: 496px;
        background: #fff;
        border-radius: 10px;
        padding: 18px 25px 20px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.06);
    }

    .wrapper :where(.title, li, li i, .details) {
        display: flex;
        align-items: center;
    }

    .title img {
        max-width: 21px;
    }

    .title h2 {
        font-size: 21px;
        font-weight: 600;
        margin-left: 8px;
    }

    .wrapper .content {
        margin: 10px 0;
    }

    .content p {
        font-size: 15px;
    }

    .content ul {
        display: flex;
        flex-wrap: wrap;
        padding: 7px;
        margin: 12px 0;
        border-radius: 5px;
        border: 1px solid #a6a6a6;
    }

    .content ul li {
        color: #333;
        margin: 4px 3px;
        list-style: none;
        border-radius: 5px;
        background: #F2F2F2;
        padding: 5px 8px 5px 10px;
        border: 1px solid #e3e1e1;
    }

    .content ul li i {
        height: 20px;
        width: 20px;
        color: #808080;
        margin-left: 8px;
        font-size: 12px;
        cursor: pointer;
        border-radius: 50%;
        background: #dfdfdf;
        justify-content: center;
    }

    .content ul input {
        flex: 1;
        padding: 5px;
        border: none;
        outline: none;
        font-size: 16px;
    }

    .wrapper .details {
        justify-content: space-between;
    }

    .details button {
        border: none;
        outline: none;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        padding: 9px 15px;
        border-radius: 5px;
        background: #5372F0;
        transition: background 0.3s ease;
    }
</style>

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Edit category</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('products.store')}}" method="POST" class="theme-form" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Name product</label>
                                <input value="{{$product->name}}" name="name" class="form-control <?php echo ($errors->first('name') ? 'is-invalid' : ' ') ?>" id="exampleInputEmail1" type="text" placeholder="Enter name product" value="{{old('name')}}">
                                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Image product</label>
                                <input name="image" class="form-control <?php echo ($errors->first('image') ? 'is-invalid' : ' ') ?>" type="file" >
                                <div class="invalid-feedback">{{$errors->first('image')}}</div>
                                <div class="mb-3 mt-3">
                                    <img width="100px" src="{{asset('storage/images/product/'.$product->image)}}" alt="">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Gallery product</label>
                                <input name="image_list[]" class="form-control <?php echo ($errors->first('image_list') ? 'is-invalid' : ' ') ?>" type="file" multiple>
                                <div class="invalid-feedback">{{$errors->first('image_list')}}</div>
                            </div>
                            <div class="gallery my-gallery card-body row" itemscope="" data-pswp-uid="1">
                                @foreach ($product->image_list as $img)
                                <figure class="col-xl-3 col-md-4 xl-33" itemprop="associatedMedia" itemscope="">
                                    <a href="{{asset('storage/images/product/'. $img)}}" itemprop="contentUrl" data-size="1600x950"><img class="img-thumbnail" src="{{asset('storage/images/product/'. $img)}}" itemprop="thumbnail" alt="Image description"></a>
                                </figure>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Price product</label>
                                <input name="price" class="form-control <?php echo ($errors->first('price') ? 'is-invalid' : ' ') ?>" type="number">
                                <div class="invalid-feedback">{{$errors->first('price')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Sale price product</label>
                                <input name="sale_price" class="form-control <?php echo ($errors->first('sale_price') ? 'is-invalid' : ' ') ?>" type="number">
                                <div class="invalid-feedback">{{$errors->first('sale_price')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="tag">Tag product</label>
                                <div class="wrapper">
                                    <div class="title">
                                    </div>
                                    <div class="content">
                                        <ul id="ulTag"><input type="text" id="tag" spellcheck="false" class="form-control <?php echo ($errors->first('tag') ? 'is-invalid' : ' ') ?>"></ul>
                                        <input type="text" name="tag" id="result" hidden>
                                    </div>
                                    <div class="details">
                                        <p><span>10</span> tags are remaining</p>
                                        <button>Remove All</button>
                                    </div>
                                </div>
                                <div class="invalid-feedback">{{$errors->first('tag')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Summary product</label>
                                <textarea name="summary" class="form-control <?php echo ($errors->first('summary') ? 'is-invalid' : ' ') ?>" id="summary"></textarea>
                                <script>
                                    CKEDITOR.replace('summary');
                                </script>
                                <div class="invalid-feedback">{{$errors->first('summary')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Description product</label>
                                <textarea name="description" class="form-control <?php echo ($errors->first('description') ? 'is-invalid' : ' ') ?>" id="description"></textarea>
                                <script>
                                    CKEDITOR.replace('description');
                                </script>
                                <div class="invalid-feedback">{{$errors->first('description')}}</div>
                            </div>
                            <fieldset class="mb-3">
                                <div class="row">
                                    <label class="col-form-label col-sm-3 pt-0">Status</label>
                                    <div class="col-sm-9">
                                        <div class="form-check radio radio-primary">
                                            <input class="form-check-input <?php echo ($errors->first('status') ? 'is-invalid' : ' ') ?>" <?php echo ($errors->first('status') ? 'required' : ' ') ?> id="radio11" type="radio" name="status" value="0">
                                            <label class="form-check-label" for="radio11">Show</label>
                                        </div>
                                        <div class="form-check radio radio-primary">
                                            <input class="form-check-input <?php echo ($errors->first('status') ? 'is-invalid' : ' ') ?>" <?php echo ($errors->first('status') ? 'required' : ' ') ?> id="radio22" type="radio" name="status" value="1">
                                            <label class="form-check-label" for="radio22">Hidden</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">{{$errors->first('status')}}</div>
                            </fieldset>
                            <div class="mb-3">
                                <label class="col-form-label col-sm-3 pt-0" for="exampleFormControlSelect9">Category product</label>
                                <select name="category_id" class="form-select digits <?php echo ($errors->first('category_id') ? 'is-invalid' : ' ') ?>" id="exampleFormControlSelect9">
                                    <option value="">Please select category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{$errors->first('category_id')}}</div>
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
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    const ul = document.querySelector("#ulTag"),
        input = document.querySelector("#tag"),
        tagNumb = document.querySelector(".details span");

    let maxTags = 10;
    tags = ["coding", "nepal"];

    countTags();
    createTag();

    function countTags() {
        input.focus();
        tagNumb.innerText = maxTags - tags.length;
    }

    function createTag() {
        ul.querySelectorAll(".liTag").forEach(li => li.remove());
        tags.slice().reverse().forEach(tag => {
            let liTag = `<li class="liTag">${tag} <i class="uit uit-multiply" onclick="remove(this, '${tag}')"></i></li>`;
            ul.insertAdjacentHTML("afterbegin", liTag);
        });

        // var liTag = document.querySelectorAll('.liTag');
        // console.log(liTag);
        // for (let index = 0; index < liTag.length; index++) {
        //     tags.push(liTag[index].value);
        //     // console.log(tags);
        // }
        // const new_arr = tags.filter(item => item !== 0);
        // input.value = new_arr;
        // console.log(input.value);
        document.getElementById("result").value = tags;
        document.getElementById("result").placeholder = tags;
        countTags();
    }

    function remove(element, tag) {
        let index = tags.indexOf(tag);
        tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
        element.parentElement.remove();
        countTags();
    }

    function addTag(e) {
        if (e.key == "Enter") {
            let tag = e.target.value.replace(/\s+/g, ' ');
            if (tag.length > 1 && !tags.includes(tag)) {
                if (tags.length < 10) {
                    tag.split(',').forEach(tag => {
                        tags.push(tag);
                        createTag();
                    });
                }
            }
            e.target.value = "";
        }
    }


    input.addEventListener("keyup", addTag);

    const removeBtn = document.querySelector(".details button");
    removeBtn.addEventListener("click", (e) => {
        e.preventDefault();
        tags.length = 0;
        ul.querySelectorAll("li").forEach(li => li.remove());
        countTags();
    });
</script>
@endsection