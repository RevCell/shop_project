@extends("admin.layout.master")
@section("admin_panel")
    <div class="content-wrapper">
        <hr>
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">افزودن و ویرایش مشخصات</h1>
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
                                    <form action="{{Route("product_property.store" , $product)}}" method="post">
                                        @csrf

                                        @foreach($property_groups as $pgs)
                                        <div>
                                            <h4>{{$pgs->title}}</h4>
                                            @foreach($pgs->properties as $prop)
                                                <div>
                                                    <label for="ti">{{$prop->title}}</label>
                                                    <input type="text" name="property[{{$prop->id}}][content]"
                                                           class="form-control" id="ti" value="{{$prop->default_content($product)}}">
                                                </div>
                                            @endforeach
                                            <hr>
                                        </div>
                                        @endforeach
                                        <br>
                                        <button class="btn btn-success">افزودن مشخصات</button>
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
