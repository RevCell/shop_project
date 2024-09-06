@extends("admin.layout.master")
@section("admin_panel")

    <div class="content-wrapper">
        <br>
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">لیست دسته بندی ها</h3>

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
                                    <th>نام فرستنده</th>
                                    <th>محصول</th>
                                    <th>وضعیت</th>
                                    <th>بررسی</th>
                                    <th>حذف</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product->comments as $comment)
                                    <tr>
                                        <td>{{$comment->id}}</td>
                                        <td>{{$comment->user->name}}</td>
                                        <td>{{$comment->product->title}}</td>
                                        <td>
                                            @if($comment->status == 0)
                                                <p>در انتظار بررسی</p>
                                            @else
                                                <p>تایید شده</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{Route("product.comment.edit",['product'=>$product,'comment'=>$comment])}}" class="badge badge-warning">بررسی</a>
                                        </td>
                                        <td>
                                            <form action="{{Route("product.comment.delete",$comment)}}" method="post">
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
