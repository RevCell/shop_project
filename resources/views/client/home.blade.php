@extends("client.layout.master")
@section("main_content")
    <div id="container">

        <div class="container">
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-xs-12">
                    <!-- Slideshow Start-->
                    <div class="slideshow single-slider owl-carousel">
                        <div class="item"> <a href="#"><img class="img-responsive" src="image/slider/banner-2.jpg" alt="banner 2" /></a> </div>
                        <div class="item"> <a href="#"><img class="img-responsive" src="image/slider/banner-1.jpg" alt="banner 1" /></a> </div>
                    </div>
                    <!-- Slideshow End-->
                    <!-- Banner Start-->
                    <!-- Banner End-->
                    <!-- محصولات Tab Start -->
                    <h2>محصولات ویژه</h2>
                    <div id="product-tab" class="product-tab">
                        <ul id="tabs" class="tabs">
                            @foreach($featured_cat->parent_category as $fpg)
                                <li><a href="#tab-featured-{{$fpg->id}}">{{$fpg->title}}</a></li>
                            @endforeach
                        </ul>
                        @foreach($featured_cat->parent_category as $fpg2)
                        <div id="tab-featured-{{$fpg2->id}}" class="tab_content">
                            <div class="owl-carousel product_carousel_tab">
                                @foreach($fpg2->allProducts() as $pro )
                                <div class="product-thumb clearfix">
                                    <div class="image"><a href="{{route("client.product.detail",$pro)}}"><img src="{{str_replace("public","/storage",$pro->image)}}" alt="{{$pro->title}}"  class="img-responsive" /></a></div>
                                    <div class="caption">
                                        <h4><a href="{{route("client.product.detail",$pro)}}">{{$pro->title}}</a></h4>
                                        <p class="price">
                                            @if($pro->discount()->exists())
                                            <span class="price-new">{{$pro->final_price()}}  تومان</span>
                                            <span class="price-old">{{$pro->price}}  تومان</span>
                                            <span class="saving">{{$pro->discount->amount}}%</span></p>
                                            @else
                                            <span class="price-new">{{$pro->final_price()}}  تومان</span>
                                            @endif
                                    </div>
                                    <div class="button-group">




                                        @if($pro->cart_chk())
                                            <form action="{{Route("cart.update",$pro)}}" method="post">
                                                @csrf
                                                @method("patch")
                                                <div class="qty">
                                                    <input type="text" name="amount" value="1" hidden>

                                                    <div class="clear"></div>
                                                </div>
                                                <button type="submit"
                                                        id="button-cart"
                                                        class="btn btn-primary btn-lg">
                                                    افزودن به سبد</button>
                                            </form>
                                        @else
                                            <form action="{{Route("cart.store",$pro)}}" method="post">
                                                @csrf
                                                <div class="qty">
                                                    <input type="text" name="amount" value="1" hidden>
                                                    <div class="clear"></div>
                                                </div>
                                                <input type="text" value="{{$pro->id}}" name="product_id" hidden>
                                                <button type="submit"
                                                        id="button-cart"
                                                        class="btn btn-primary btn-lg">افزودن به سبد
                                                </button>
                                            </form>
                                        @endif



                                        <div class="add-to-links">
                                            @if($pro->like_chk())
                                                <form action="{{Route("unlike",$pro)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="wishlist"><i class="fa fa-heart like"></i></button>
                                                </form>
                                            @else
                                                <form action="{{Route("like",$pro)}}" method="post">
                                                    @csrf
                                                    <input type="text" value="{{$pro->id}}" name="like" hidden>
                                                    <button class="wishlist"><i class="fa fa-heart"></i></button>
                                                </form>
                                            @endif
                                            <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                        @endforeach
                    </div>    <!-- محصولات Tab Start -->

                        <!-- Banner Start -->
                    <div class="marketshop-banner">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="#"><img src="image/banner/sample-banner-4-600x250.jpg" alt="2 Block Banner" title="2 Block Banner" /></a></div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="#"><img src="image/banner/sample-banner-5-600x250.jpg" alt="2 Block Banner 1" title="2 Block Banner 1" /></a></div>
                        </div>
                    </div>
                    <!-- Banner End -->
                    <!-- دسته ها محصولات Slider Start-->

                    <div class="category-module" id="latest_category">

                        <div class="category-module-content">
                            <div id="tab-cat1" class="tab_content">
                                @foreach($categories as $lvl01)
                                    <h3 class="subtitle">{{$lvl01->title}}</h3>
                                <div class="owl-carousel latest_category_tabs">

                                    @foreach($lvl01->allProducts() as $pros)
                                        <div class="product-thumb">
                                            <div class="image">
                                                <a href="{{route("client.product.detail",$pros)}}">
                                                    <img src="{{str_replace("public",'/storage',$pros->image)}}" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" />
                                                </a>
                                            </div>
                                            <div class="caption">
                                                <h4><a href="{{Route("client.product.detail",$pros)}}">{{$pros->title}}</a></h4>
                                                <p class="price">
                                                    @if($pros->discount()->exists())
                                                        <span class="price-new">
                                                    {{$pros->final_price()}}
                                                     تومان</span>
                                                        <span class="price-old">
                                                    {{$pros->price}}
                                                     تومان</span>
                                                        @if($pros->discount()->exists())
                                                            <span class="saving">{{$pros->discount->amount}} %</span>
                                                        @endif
                                                    @else
                                                        <span class="price-new">
                                                    {{$pros->price}}
                                                     تومان</span>
                                                    @endif
                                                </p>
                                                <div class="rating">
                                                <span class="fa fa-stack">
                                                    <i class="fa fa-star fa-stack-2x"></i>
                                                    <i class="fa fa-star-o fa-stack-2x"></i>
                                                </span>
                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x">

                                                    </i><i class="fa fa-star-o fa-stack-2x"></i>
                                                </span>
                                                    <span class="fa fa-stack">
                                                    <i class="fa fa-star fa-stack-2x"></i>
                                                    <i class="fa fa-star-o fa-stack-2x"></i>
                                                </span> <span class="fa fa-stack">
                                                    <i class="fa fa-star fa-stack-2x"></i>
                                                    <i class="fa fa-star-o fa-stack-2x"></i>
                                                </span> <span class="fa fa-stack">
                                                    <i class="fa fa-star-o fa-stack-2x"></i>
                                                </span>
                                                </div>
                                            </div>
                                            <div class="button-group">

                                                @if($pros->cart_chk())
                                                    <form action="{{Route("cart.update",$pros)}}" method="post">
                                                        @csrf
                                                        @method("patch")
                                                        <div class="qty">
                                                            <input type="text" name="amount" value="1" hidden>

                                                            <div class="clear"></div>
                                                        </div>
                                                        <button type="submit"
                                                                id="button-cart"
                                                                class="btn btn-primary btn-lg">
                                                            افزودن به سبد</button>
                                                    </form>
                                                @else
                                                    <form action="{{Route("cart.store",$pros)}}" method="post">
                                                        @csrf
                                                        <div class="qty">
                                                            <input type="text" name="amount" value="1" hidden>
                                                            <div class="clear"></div>
                                                        </div>
                                                        <input type="text" value="{{$pros->id}}" name="product_id" hidden>
                                                        <button type="submit"
                                                                id="button-cart"
                                                                class="btn btn-primary btn-lg">افزودن به سبد
                                                        </button>
                                                    </form>
                                                @endif
                                                <div class="add-to-links">
                                                    @if($pros->like_chk())
                                                        <form action="{{Route("unlike",$pros)}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="wishlist"><i class="fa fa-heart like"></i></button>
                                                        </form>
                                                    @else
                                                        <form action="{{Route("like",$pros)}}" method="post">
                                                            @csrf
                                                            <input type="text" value="{{$pros->id}}" name="like" hidden>
                                                            <button class="wishlist"><i class="fa fa-heart"></i></button>
                                                        </form>
                                                    @endif
                                                    <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- دسته ها محصولات Slider End-->


                    <!-- برند Logo Carousel Start-->
                    <div id="carousel" class="owl-carousel nxt">
                        <div class="item text-center"> <a href="#"><img src="image/product/apple_logo-100x100.jpg" alt="پالم" class="img-responsive" /></a> </div>
                        <div class="item text-center"> <a href="#"><img src="image/product/canon_logo-100x100.jpg" alt="سونی" class="img-responsive" /></a> </div>
                        <div class="item text-center"> <a href="#"><img src="image/product/apple_logo-100x100.jpg" alt="کنون" class="img-responsive" /></a> </div>
                        <div class="item text-center"> <a href="#"><img src="image/product/canon_logo-100x100.jpg" alt="اپل" class="img-responsive" /></a> </div>
                        <div class="item text-center"> <a href="#"><img src="image/product/apple_logo-100x100.jpg" alt="اچ تی سی" class="img-responsive" /></a> </div>
                        <div class="item text-center"> <a href="#"><img src="image/product/canon_logo-100x100.jpg" alt="اچ پی" class="img-responsive" /></a> </div>
                        <div class="item text-center"> <a href="#"><img src="image/product/apple_logo-100x100.jpg" alt="brand" class="img-responsive" /></a> </div>
                        <div class="item text-center"> <a href="#"><img src="image/product/canon_logo-100x100.jpg" alt="brand1" class="img-responsive" /></a> </div>
                    </div>
                    <!-- برند Logo Carousel End -->
                </div>
                <!--Middle Part End-->
            </div>
        </div>
    </div>
    <!-- Feature Box Start-->
    <div class="container">
        <div class="custom-feature-box row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="feature-box fbox_1">
                    <div class="title">ارسال رایگان</div>
                    <p>برای خرید های بیش از 100 هزار تومان</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="feature-box fbox_2">
                    <div class="title">پس فرستادن رایگان</div>
                    <p>بازگشت کالا تا 24 ساعت پس از خرید</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="feature-box fbox_3">
                    <div class="title">کارت هدیه</div>
                    <p>بهترین هدیه برای عزیزان شما</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="feature-box fbox_4">
                    <div class="title">امتیازات خرید</div>
                    <p>از هر خرید امتیاز کسب کرده و از آن بهره بگیرید</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Box End-->
@endsection
