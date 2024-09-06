@extends("admin.layout.master")
@section("admin_panel")
    <div class="content-wrapper">
        <hr>
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">ایجاد دسته بندی جدید</h1>
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
                                    <form action="{{Route("category.store")}}" method="post">
                                        @csrf
                                        <label for="ti">عنوان دسته بندی</label>
                                        <input type="text" name="title" class="form-control" id="ti">
                                        <br>
                                        <label for="ti">سرگروه دسته بندی را انتخاب کنید</label>
                                        <select name="category_id" id="" class="form-control">
                                            <option value="">سرگروه</option>
                                            @foreach($categories as $cat)
                                                <option value="{{$cat->id}}">{{$cat->title}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <div>
                                            <label >گروه مشخصات دسته بندی را انتخاب کنید</label>
                                            <br>
                                            @foreach($properties as $props)
                                        <label for="ti">{{$props->title}}</label>
                                        <input type="checkbox" name="prop_group[]" value="{{$props->id}}">
                                            @endforeach
                                        </div>
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
