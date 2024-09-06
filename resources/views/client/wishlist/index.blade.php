@extends("client.layout.master")
@section("main_content")
    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li><a href="{{Route("shop_home")}}"><i class="fa fa-home"></i></a></li>
                <li><a href="#">حساب کاربری</a></li>
                <li><a href="{{Route("wishlist")}}">لیست علاقه مندی ها</a></li>
            </ul>
            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-12">
                    <h1 class="title">لیست علاقه مندی ها</h1>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td class="text-center">تصویر</td>
                                <td class="text-left">نام محصول</td>
                                <td class="text-left">برند</td>
                                <td class="text-right">موجودی</td>
                                <td class="text-right">قیمت واحد</td>
                                <td class="text-right">عملیات</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="text-center"><a href="{{Route("client.product.detail",$product)}}"><img src="{{str_replace("public",'/storage',$product->image)}}" alt="{{$product->title}}" width="80" /></a></td>
                                <td class="text-left"><a href="product.html">{{$product->title}}</a></td>
                                <td class="text-left">{{$product->brand->title}}</td>
                                <td class="text-right">موجود</td>
                                <td class="text-right"><div class="price">
                                        @if($product->discount()->exists())
                                            {{$product->final_price()}}  تومان
                                        @else
                                            {{$product->price}}  تومان
                                        @endif
                                    </div></td>
                                <td class="text-right">



                                    @if($product->cart_chk())
                                        <form action="{{Route("cart.update",$product)}}" method="post">
                                            @csrf
                                            @method("patch")
                                            <div class="qty">
                                                <input type="text" name="amount" value="1" hidden>

                                                <div class="clear"></div>
                                            </div>
                                            <button class="btn btn-primary" title="" data-toggle="tooltip"
                                                    onClick="cart.add('48');"
                                                    type="submit"
                                                    data-original-title="افزودن به سبد">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{Route("cart.store",$product)}}" method="post">
                                            @csrf
                                            <div class="qty">
                                                <input type="text" name="amount" value="1" hidden>
                                                <div class="clear"></div>
                                            </div>
                                            <input type="text" value="{{$product->id}}" name="product_id" hidden>
                                            <button class="btn btn-primary" title="" data-toggle="tooltip"
                                                    onClick="cart.add('48');"
                                                    type="submit"
                                                    data-original-title="افزودن به سبد">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    @endif






                                    <form action="{{Route("unlike",$product)}}" method="post">
                                        @csrf
                                        @method("delete")
                                        <button class="btn btn-danger" ><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--Middle Part End -->
            </div>
        </div>
    </div>
@endsection
