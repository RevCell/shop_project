@extends("admin.layout.master")
@section("admin_panel")
    <div class="content-wrapper">
        <hr>
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">ویرایش محصول {{$product->title}}</h1>
        </div>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-8 connectedSortable">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <form action="{{Route("product.update",$product)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method("patch")
                                        <br>
                                        <label for="ti">دسته بندی محصول را انتخاب کنید</label>
                                        <select name="category_id" id="ti" class="form-control">
                                            @foreach($category as $cat)
                                                <option value="{{$cat->id}}"
                                                @if($cat->id == $product->category_id)
                                                    selected
                                                @endif
                                                >{{$cat->title}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <label for="br">برند محصول را انتخاب کنید</label>
                                        <select name="brand_id" id="br" class="form-control">
                                            @foreach($brand as $br)
                                                <option value="{{$br->id}}"
                                                    @if($br->id == $product->brand_id)
                                                       selected
                                                    @endif
                                                >{{$br->title}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <label for="ti02">عنوان محصول</label>
                                        <input type="text" name="title" class="form-control" id="ti02" value="{{$product->title}}">
                                        <br>
                                        <label for="ti03">قیمت محصول (تومان)</label>
                                        <input type="number" min="50" name="price" class="form-control" id="ti03" value="{{$product->price}}">
                                        <br>
                                        <label for="ti04">اسلاگ</label>
                                        <input type="text" name="slug" class="form-control" id="ti04" value="{{$product->slug}}">
                                        <br>
                                        <label for="ti05">تصویر محصول</label>
                                        <input type="file" class="form-control" name="image" id="ti05">
                                        <img src="{{str_replace("public","/storage",$product->image)}}" alt="{{$product->title}}" height="200">
                                        <br>
                                        <label for="ti06">توضیحات محصول</label>
                                        <textarea name="description" class="form-control" id="ti06" cols="30" rows="5">{{$product->description}}</textarea>
                                        <br>
                                        <button class="btn btn-success">بروز رسانی محصول</button>
                                    </form>
                                    @include("admin.layout.error")
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
