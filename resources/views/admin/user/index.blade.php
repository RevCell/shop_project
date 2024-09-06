@extends("admin.layout.master")
@section("admin_panel")

        <div class="content-wrapper">
            <br>
            <div class="row">
            <div class="col-md-10">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">لیست کاربران</h3>

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
                                <th>نام کاربر</th>
                                <th>نقش</th>
                                <th>تغییر نقش</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->role->title}}</td>
                                    <td><a href="{{Route("user.edit",$user)}}" class="badge badge-warning">تغییر نقش</a></td>
                                    <td>
                                        @if($user->id == 1)
                                            <h5 >Admin user can not be removed</h5>
                                        @else
                                            <form action="{{Route("user.delete",$user)}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <button class="badge badge-danger">حذف</button>
                                            </form>
                                        @endif
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
