@extends("admin.layout.master")
@section("admin_panel")

    <div class="content-wrapper">
        <br>
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">لیست گروه مشخصات</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
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
                                    <th>عنوان مشخصات</th>
                                    <th>گروه</th>
                                    <th>ویرایش</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($properties as $prop)
                                    <tr>
                                        <td>{{$prop->id}}</td>
                                        <td>{{$prop->title}}</td>
                                        <td>{{$prop->property_group->title}}</td>
                                        <td><a href="{{Route("property.edit",$prop)}}" class="badge badge-warning">ویرایش</a></td>
                                        <td>
                                            <form action="{{Route("property.delete",$prop)}}" method="post">
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
