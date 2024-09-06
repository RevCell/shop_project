@extends("client.layout.master")
@section("main_content")
    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li><a href="{{route("shop_home")}}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{route("cart.index")}}">سبد خرید</a></li>
            </ul>
            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-12">
                    <h1 class="title">سبد خرید</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td class="text-center">تصویر</td>
                                <td class="text-left">نام محصول</td>
                                <td class="text-left">مدل</td>
                                <td class="text-left">تعداد</td>
                                <td class="text-left">تخفیف</td>
                                <td class="text-right">قیمت واحد</td>
                                <td class="text-right">کل</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product as $pro)

                            <tr>
                                <td class="text-center"><a href="{{route("client.product.detail",$pro)}}"><img src="{{str_replace("public",'/storage',$pro->image)}}" alt="{{$pro->title}}" title="{{$pro->title}}" class="img-thumbnail" width="85" /></a></td>
                                <td class="text-left"><a href="{{route("client.product.detail",$pro)}}">{{$pro->title}}</a><br /></td>
                                <td class="text-left">{{$pro->brand->title}}</td>
                                <td class="text-left"><div class="input-group btn-block quantity">

                                        <span class="input-group-btn">
                                            <div class="qty">
                                                <form action="{{Route("cart.update",$pro)}}" method="post" class="input-group">
                                                @csrf
                                                @method("patch")
                                                <input type="number" name="amount" value="{{$pro->cart_content->amount}}" id="input-quantity" class="form-control"/>
                                                    <button type="submit"
                                                            data-toggle="tooltip"
                                                            title="بروزرسانی"
                                                            class="btn btn-primary">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="qty">
                                                <form action="{{Route("cart.delete",$pro)}}" method="post" class="input-group">
                                                @csrf
                                                @method("delete")
                                                    <button type="submit"
                                                            data-toggle="tooltip"
                                                            title="حذف"
                                                            class="btn btn-danger">
                                                            <i class="fa fa-times-circle"></i>
                                                    </button>
                                                </form>
                                            </div>

                        </span></div></td>
                                <td class="text-right">
                                    @if ($pro->discount()->exists())
                                        {{$pro->discount->amount}} درصد
                                        <br>
                                        <h3 class="price-old">{{$pro->price}} تومان</h3>
                                    @else
                                        <p>ندارد</p>
                                    @endif
                                </td>
                                <td class="text-right">{{$pro->final_price()}} تومان</td>
                                <td class="text-right">{{$pro->cart_content->amount * $pro->final_price()}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-8">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="text-right"><strong>جمع کل:</strong></td>
                                    <td class="text-right">{{$total_price}} تومان</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="pull-left"><a href="index.html" class="btn btn-default">ادامه خرید</a></div>
                        <div class="pull-right"><a href="checkout.html" class="btn btn-primary">تسویه حساب</a></div>
                    </div>
                </div>
                <!--Middle Part End -->
            </div>
        </div>
    </div>
@endsection
