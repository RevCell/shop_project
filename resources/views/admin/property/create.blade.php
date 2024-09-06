@extends("admin.layout.master")
@section("admin_panel")
    <div class="content-wrapper">
        <hr>
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">ایجاد گروه مشخصات</h1>
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
                                    <form action="{{Route("property.store")}}" method="post">
                                        @csrf
                                        <label for="ti">عنوان گروه مشخصات</label>
                                        <input type="text" name="title" class="form-control" id="ti">
                                        <br>
                                        <select name="prop_group" id="" class="form-control">
                                            @foreach($prop_group as $pg)
                                                <option value="{{$pg->id}}">{{$pg->title}}</option>
                                            @endforeach
                                        </select>
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
