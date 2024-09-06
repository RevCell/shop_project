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
                    <section class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <form action="{{Route("brand.store")}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <label for="ti">عنوان برند</label>
                                        <input type="text" name="title" class="form-control" id="ti">
                                        <br>
                                        <label for="ti">تصویر برند را انتخاب کنید</label>
                                        <input type="file" class="form-control" name="image">
                                        <br>
                                        <button class="btn btn-success">ایجاد</button>
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
