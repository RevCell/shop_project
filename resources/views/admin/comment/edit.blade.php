@extends("admin.layout.master")
@section("admin_panel")
    <div class="content-wrapper">
        <hr>
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">ایجاد محصول جدید</h1>
        </div>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-8 connectedSortable">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <form action="{{Route("product.comment.update",['comment'=>$comment,'product'=>$product])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <br>
                                        <label for="ti02">نام فرستنده</label>
                                        <input type="text" name="title" class="form-control" id="ti02">
                                        <br>
                                        <label for="ti03">متن دیدگاه</label>
                                        <input type="number" min="50" name="price" class="form-control" id="ti03">
                                        <br>
                                        <p>وضعیت دیدگاه</p>
                                        <label for="ti04">تایید</label>
                                        <input type="radio" name="status" value="1" >
                                        <label for="ti04">عدم تایید</label>
                                        <input type="radio" name="status" value="0">

                                        <button class="btn btn-success">اضافه کردن محصول</button>
                                    </form>
                                    @include("admin.layout.error")
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
