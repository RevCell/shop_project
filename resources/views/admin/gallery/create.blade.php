@extends("admin.layout.master")
@section("admin_panel")
    <div class="content-wrapper">
        <hr>
        <div class="col-sm-6">
            <h2 class="m-0 text-dark">مدیریت گالری تصاویر محصولات</h2>
            <hr>
            <a href="{{Route("product.index")}}" class="btn btn-info">بازگشت به لیست محصولات</a>
        </div><!-- /.col -->
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <form action="{{Route("gallery.store",$product)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="address" class="form-control">
                                        <br>
                                        <button class="btn btn-success">افزودن تصویر به گالری</button>
                                    </form>
                                    @include("admin.layout.error")
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <div class="row">
            @foreach($product->gallery as $pics)
            <div class="col-lg-3 col-6">

                <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <img src="{{str_replace("public","/storage",$pics->address)}}" alt="{{$pics->address}}"
                                 height="200">
                        </div>
                        <p class="small-box-footer">نوع عکس: {{$pics->extension}} </p>
                        <form action="{{Route("gallery.delete",['product_gallery'=>$pics,'product'=>$product])}}" method="post" >
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger">حذف</button>
                        </form>
                    </div>

            </div>
            @endforeach
        </div>
    </div>
@endsection
