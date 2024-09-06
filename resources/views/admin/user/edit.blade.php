@extends("admin.layout.master")
@section("admin_panel")
    <div class="content-wrapper">
        <hr>
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">ویرایش پروفایل {{$user->name}}</h1>
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
                                    <form action="{{Route("user.update",$user)}}" method="post">
                                        @csrf
                                        @method("patch")
                                        <label for="ti">نام کابر</label>
                                        <input type="text" name="name" class="form-control" id="ti" disabled value="{{$user->name}}">
                                        <br>
                                        <label for="ti">email</label>
                                        <input type="text" name="email" class="form-control" id="ti" disabled value="{{$user->email}}">
                                        <br>
                                        <label >نقش</label>
                                        <select name="role" class="form-control">
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->title}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <button class="btn btn-success">بروز رسانی</button>
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
