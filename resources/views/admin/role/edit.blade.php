@extends("admin.layout.master")
@section("admin_panel")
    <div class="content-wrapper">
        <hr>
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">بروزرسانی نقش {{$role->title}}</h1>
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
                                    <form action="{{Route("role.update",$role)}}" method="post">
                                        @csrf
                                        @method("patch")
                                        <h4 for="ti">عنوان نقش</h4>
                                        <input type="text" name="title"
                                              value="{{$role->title}}" class="form-control" id="ti">
                                        <br>
                                        <h4>دسترسی ها</h4>
                                        @foreach($permissions as $per)
                                            <label>{{$per->description}}</label>
                                            <input type="checkbox" name="permission[]"
                                                   @if($role->permissions()->where("permission_id",$per->id)->exists())
                                                       checked
                                                   @endif
                                                   value="{{$per->id}}">
                                        @endforeach
                                        <br>

                                        <br>
                                        <button class="btn btn-success">بروزرسانی</button>
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
