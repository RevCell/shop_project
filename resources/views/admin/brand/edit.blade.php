@extends("admin.layout.master")
@section("admin_panel")
    <div class="content-wrapper">
        <hr>
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">ایجاد برند جدید</h1>
        </div><!-- /.col -->
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-6 connectedSortable">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <form action="{{Route("brand.update",$brand)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method("patch")
                                        <label for="ti">عنوان برند</label>
                                        <input type="text" name="title" class="form-control" id="ti" value="{{$brand->title}}">
                                        <br>
                                        <label for="ti">تصویر برند را انتخاب کنید</label>
                                        <input type="file" class="form-control" name="image">
                                        <br>
                                        <img src="{{str_replace("public",'/storage',$brand->image)}}" alt="{{$brand->title}}" height="120">
                                        <br>
                                        <br>
                                        <button class="btn btn-success">بروز رسانی برند</button>
                                    </form>
                                    @include("admin.layout.error")
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
