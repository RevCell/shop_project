@extends("admin.layout.master")
@section("admin_panel")
    <div class="content-wrapper">
        <hr>
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">ایجاد محصول جدید</h1>
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
                                    <form action="{{Route("product.store")}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <br>
                                        <label for="ti">دسته بندی محصول را انتخاب کنید</label>
                                        <select name="category_id" id="ti" class="form-control">
                                            @foreach($category as $cat)
                                                <option value="{{$cat->id}}">{{$cat->title}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <label for="br">برند محصول را انتخاب کنید</label>
                                        <select name="brand_id" id="br" class="form-control">
                                            @foreach($brand as $br)
                                                <option value="{{$br->id}}">{{$br->title}}</option>
                                            @endforeach
                                        </select>
                                            <br>
                                        <label for="ti02">عنوان محصول</label>
                                        <input type="text" name="title" class="form-control" id="ti02">
                                        <br>
                                        <label for="ti03">قیمت محصول (تومان)</label>
                                        <input type="number" min="5" name="price" class="form-control" id="ti03">
                                        <br>
                                        <label for="ti04">اسلاگ</label>
                                        <input type="text" name="slug" class="form-control" id="ti04">
                                        <br>
                                        <label for="ti05">تصویر محصول</label>
                                        <input type="file" class="form-control" name="image" id="ti05">
                                        <br>
                                        <label for="ti06">توضیحات محصول</label>
                                        <textarea name="description" class="form-control" id="ti06" cols="30" rows="5"></textarea>
                                        <br>
                                        <button class="btn btn-success">اضافه کردن محصول</button>
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
