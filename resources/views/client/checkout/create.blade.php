@extends("client.layout.master")
@section("main_content")
    <div class="container">
    <div id="content" class="col-sm-12">
        <h1 class="title">تسویه حساب</h1>
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-user"></i> اطلاعات شخصی شما</h4>
                    </div>
                    <div class="panel-body">
                        <fieldset id="account">
                            <div class="form-group">
                                <label for="input-payment-firstname" class="control-label">نام</label>
                                <input type="text" class="form-control" id="input-payment-firstname" value="{{auth()->user()->name}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="input-payment-email" class="control-label">آدرس ایمیل</label>
                                <input type="text" class="form-control" id="input-payment-email" value="{{auth()->user()->email}}" disabled>
                            </div>
                        </fieldset>
                    </div>
                </div>

            </div>
            <div class="col-sm-8">
                <div class="row">



                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> سبد خرید</h4>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td class="text-center">تصویر</td>
                                            <td class="text-left">نام محصول</td>
                                            <td class="text-left">تعداد</td>
                                            <td class="text-right">قیمت واحد</td>
                                            <td class="text-right">کل</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cart as $pro)
                                        <tr>
                                            <td class="text-center"><a href="{{route("client.product.detail",$pro)}}"><img src="{{str_replace("public","/storage",$pro->image)}}" alt="{{$pro->title}}" title="{{$pro->title}}" width="55" class="img-thumbnail"></a></td>
                                            <td class="text-left"><a href="{{route("client.product.detail",$pro)}}">{{$pro->title}}</a></td>
                                            <td class="text-left">
                                                <div class="input-group btn-block" style="max-width: 200px;">
                                                    <form action="{{Route("cart.update",$pro)}}" method="post">
                                                        @csrf
                                                        @method("patch")
                                                        <input type="text" name="amount"
                                                               value="{{$pro->cart_content->amount}}" size="1"
                                                               class="form-control">
                                                        <button type="submit" data-toggle="tooltip" title="بروزرسانی"
                                                                class="btn btn-primary"><i
                                                                class="fa fa-refresh"></i></button>
                                                    </form>
                                                    <form action="{{Route("cart.delete",$pro)}}" method="post">
                                                        @csrf
                                                        @method("delete")
                                                        <button type="submit" data-toggle="tooltip"
                                                                title="حذف" class="btn btn-danger"
                                                                onClick="">
                                                            <i class="fa fa-times-circle"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                            <td class="text-right">{{$pro->final_price()}} تومان</td>
                                            <td class="text-right">{{$pro->final_price() * $pro->cart_content->amount}} تومان</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td class="text-right" colspan="4"><strong>جمع محصولات موجود در سبد خرید:</strong></td>
                                            <td class="text-right">{{$total_product}} تومان</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="4"><strong>جمع هزینه ها:</strong></td>
                                            <td class="text-right">{{$total_price}} تومان</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <form action="">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-pencil"></i>آدرس</h4>
                            </div>
                            </form>
                            <form action="{{Route("checkout.store")}}" method="post">
                                @csrf
                                <div class="panel-body">
                                    <input type="text" name="price" value="{{$total_price}}" hidden>
                                    <textarea rows="4" class="form-control" id="confirm_comment" name="address"></textarea>
                                    <br>
                                    <div class="pull-right">
                                        <input type="submit" class="btn btn-primary" id="button-confirm" value="تایید سفارش">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
