@extends("admin.layout.master")
@section("admin_panel")
    <div class="content-wrapper">
        <hr>
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">اِعمال تخفیف</h1>
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
                                    <form action="{{Route("discount.store",$product)}}" method="post" >
                                        @csrf
                                        <label for="ti01">مقدار تخفیف (درصد)</label>
                                        <input type="number" min="1" max="99" name="amount" class="form-control" id="ti01">
                                        <br>
                                        <label for="ti02">id محصول</label>
                                        <input type="number" min="1" max="99" name="product_id" class="form-control" id="ti02" value="{{$product->id}}" disabled>
                                        <br>
                                        <button class="btn btn-success">افزودن تخفیف</button>
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
