<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="image/favicon.png" rel="icon" />
    <title>مارکت شاپ - قالب HTML فروشگاهی</title>
    <meta name="description" content="Responsive and clean html template design for any kind of ecommerce webshop">
    <!-- CSS Part Start-->
    <link rel="stylesheet" type="text/css" href="/client/js/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/client/js/bootstrap/css/bootstrap-rtl.min.css" />
    <link rel="stylesheet" type="text/css" href="/client/css/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/client/css/stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="/client/css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="/client/css/owl.transitions.css" />
    <link rel="stylesheet" type="text/css" href="/client/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="/client/css/stylesheet-rtl.css" />
    <link rel="stylesheet" type="text/css" href="/client/css/responsive-rtl.css" />
    <link rel="stylesheet" type="text/css" href="/client/css/stylesheet-skin2.css" />
    <style>
        .like
        {
            color:red;
        }
    </style>


    <!-- CSS Part End-->
</head>
<body>
<div class="wrapper-wide">
    <div id="header">
        <!-- Top Bar Start-->
        <nav id="top" class="htop">
            <div class="container">
                <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
                    <div class="pull-left flip left-top">
                        <div class="links">
                            @auth()
                            <ul>
                                <li class="email"><a href="{{route("wishlist")}}"><i class="fa fa-anchor"></i>  لیست علاقه مندی ها</a></li>
                            </ul>
                            @endauth
                        </div>
                    </div>
                    <div id="top-links" class="nav pull-right flip">
                        <ul>
                            @auth()
                                <li>
                                <li>
                                    <a href="{{Route("admin_dashboard")}}" ><button class="btn btn-success">پنل ادمین</button></a>
                                    <form action="{{Route(("register.logout"))}}" method="post">
                                        @csrf
                                        @method("delete")
                                        <button class="btn btn-warning">خروج</button>
                                    </form>
                                </li>
                            @else
                                <li><a href="{{Route("login")}}">ورود</a></li>
                                <li><a href="{{Route("register.create")}}">ثبت نام</a></li>
                            @endauth

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Top Bar End-->
        <!-- Header Start-->
        <header class="header-row">
            <div class="container">
                <div class="table-container">
                    <!-- Logo Start -->
                    <div class="col-table-cell col-lg-6 col-md-6 col-sm-12 col-xs-12 inner">
                        <div id="logo"><a href="{{route("shop_home")}}"><img class="img-responsive" src="/client/image/logo.png" title="MarketShop" alt="MarketShop" /></a></div>
                    </div>
                    <!-- Logo End -->
                    @auth()
                    <!-- Mini Cart Start-->
                    <div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div id="cart">
                            <button type="button" data-toggle="dropdown" data-loading-text="بارگذاری ..." class="heading dropdown-toggle">
                                <span class="cart-icon pull-left flip"></span>
                                <span id="cart-total">تعداد محصول:
                                    <span id="total_item">
                                     {{\App\Models\Cart::get_totalproduct()}}
                                    </span>
                                </span>
                                    <span id="cart-total">مجموع قیمت:
                                    <span id="total_price">
                                    {{\App\Models\Cart::get_totalprice()}} میلیون تومان
                                    </span>
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <tbody>
                                    <table class="table">
                                        @foreach(\App\Models\Cart::get_cart() as $cart)
                                            <tr>
                                                <td class="text-center"><a href="{{route("client.product.detail",$cart)}}"><img
                                                            class="img-thumbnail" title="{{$cart->title}}"
                                                            alt="{{$cart->title}}"
                                                            src="{{str_replace("public","/storage",$cart->image)}}" width="65"></a></td>
                                                <td class="text-left"><a href="{{route("client.product.detail",$cart)}}">{{$cart->title}}</a></td>
                                                <td class="text-right">x {{$cart->cart_content->amount}}</td>
                                                <td class="text-right">{{$cart->final_price()}} تومان</td>
                                                <td class="text-center">

                                                    <form action="{{Route("cart.delete",$cart)}}" method="post" class="input-group">
                                                        @csrf
                                                        @method("delete")
                                                        <button class="btn btn-danger btn-xs remove"
                                                                title="حذف"
                                                                type="submit"><i class="fa fa-times"></i>
                                                        </button>
                                                    </form>



                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    </tbody>
                                </li>
                                <li>
                                    <div>
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td class="text-right"><strong>جمع اقلام</strong></td>
                                                <td class="text-right">{{\App\Models\Cart::get_totalproduct()}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right"><strong>جمع هزینه ها</strong></td>
                                                <td class="text-right">{{\App\Models\Cart::get_totalprice()}} میلیون تومان</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p class="checkout"><a href="{{Route("cart.index")}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> مشاهده سبد</a>
                                            &nbsp;&nbsp;&nbsp;<a href="{{Route("checkout.create")}}" class="btn btn-primary"><i class="fa fa-share"></i> تسویه حساب</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Mini Cart End-->
                    @endauth
                </div>
            </div>
        </header>
        <!-- Header End-->
        <nav id="menu" class="navbar">
            <div class="navbar-header"> <span class="visible-xs visible-sm"> منو <b></b></span></div>
            <div class="container">
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a class="home_link" title="خانه" href="{{route("shop_home")}}">خانه</a></li>
                        @foreach($categories as $category)
                            <li class="dropdown"><a href="">{{$category->title}}</a>
                                <div class="dropdown-menu">
                                    <ul>

                                        @foreach($category->parent_category as $child_cat)
                                            <li><a href="">{{$child_cat->title}}
                                                    @if($child_cat->parent_category->count() > 0)
                                                        <span>&rsaquo;</span>
                                                    @endif
                                                </a>
                                                @if($child_cat->parent_category->count() > 0)
                                                    <div class="dropdown-menu">
                                                        <ul>
                                                            @foreach($child_cat->parent_category as $la_child)
                                                                <li><a href="">{{$la_child->title}}</a> </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </li>
                        @endforeach
                        <li class="menu_brands dropdown"><a href="#">برند ها</a>
                            <div class="dropdown-menu">
                                @foreach($brands as $brand)
                                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-6">
                                    <a href="#">
                                        <img src="{{str_replace("public","/storage",$brand->image)}}" title="{{$brand->title}}" alt="{{$brand->title}}" width="45"/>
                                    </a>
                                    <a href="#">{{$brand->title}}</a>
                                </div>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
