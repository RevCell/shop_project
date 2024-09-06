@extends("admin.layout.master")
@section("admin_panel")

        <div class="content-wrapper">
            <br>
            <div class="row">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">لیست محصولات</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>عنوان</th>
                                <th>دسته بندی</th>
                                <th>برند</th>
                                <th>قیمت</th>
                                <th>تصویر</th>
                                <th>تخفیف</th>
                                <th>گالری</th>
                                <th>ویژگی ها</th>
                                <th>دیدگاه ها</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $pro)
                                <tr>
                                    <td>{{$pro->id}}</td>
                                    <td>{{$pro->title}}</td>
                                    <td>{{$pro->category->title}}</td>
                                    <td>{{$pro->brand->title}}</td>
                                    <td>{{$pro->final_price()}}</td>
                                    <td>
                                        <img src="{{str_replace("public","/storage",$pro->image)}}" alt="{{$pro->title}}" height="55">
                                    </td>
                                    <td>
                                        @if(!$pro->discount()->exists())
                                        <a href="{{Route("discount.create",$pro)}}" class="badge badge-info">اعمال تخفیف</a>
                                        @else
                                            <p>{{$pro->discount->amount}} درصد</p>
                                            <form action="{{Route("discount.delete",$pro->discount)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="badge badge-danger">حذف تخفیف</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td><a href="{{Route("gallery.create",$pro)}}" class="badge badge-warning">گالری</a></td>
                                    <td><a href="{{Route("product_property.index",$pro)}}" class="badge badge-warning">ویژگی ها</a></td>
                                    <td><a href="{{Route("product.comment.index",$pro)}}" class="badge badge-warning">دیدگاه ها</a></td>
                                    <td><a href="{{Route("product.edit",$pro)}}" class="badge badge-warning">ویرایش</a></td>
                                    <td>
                                        <form action="{{Route("product.delete",$pro)}}" method="post">
                                            @csrf
                                            @method("delete")
                                            <button class="badge badge-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @include("admin.layout.error")
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
