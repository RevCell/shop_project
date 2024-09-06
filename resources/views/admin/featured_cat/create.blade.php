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
                                    <form action="{{Route("featured_cat.store")}}" method="post">
                                        @csrf
                                        <label for="ti">سرگروه دسته بندی را انتخاب کنید</label>
                                        <select name="category_id" id="" class="form-control">
                                            @foreach($featuredcats as $fcat)
                                                <option value="{{$fcat->id}}"
                                                @if($featured->category_id ==  $fcat->id)
                                                    selected
                                                @endif
                                                >{{$fcat->title}}</option>
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
