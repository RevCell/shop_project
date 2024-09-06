@extends("admin.layout.master")
@section("admin_panel")

        <div class="content-wrapper">
            <br>
            <div class="row">
            <div class="col-md-10">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">لیست مشخصات محصول {{$product->title}}</h3>
                    <br>
                    <a href="{{Route("product_property.create",$product)}}" class="badge-primary">ویرایش</a>
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
                                <th>عنوان ویژگی</th>
                                <th>محتوا</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product->properties as $prop)
                                <tr>
                                    <td>{{$prop->id}}</td>
                                    <td>{{$prop->title}}</td>
                                    <td>{{$prop->pivot->content}}</td>
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
