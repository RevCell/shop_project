@extends("client.layout.master")
@section("main_content")
    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{Route("shop_home")}}" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="category.html" itemprop="url"><span itemprop="title">{{$product->category->title}}</span></a></li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="product.html" itemprop="url"><span itemprop="title">{{$product->title}}</span></a></li>
            </ul>
            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-9">
                    <div itemscope itemtype="http://schema.org/محصولات">
                        <h1 class="title" itemprop="name">{{$product->title}}</h1>
                        <div class="row product-info">
                            <div class="col-sm-6">
                                <div class="image">
                                    <img class="img-responsive" itemprop="image" id="zoom_01"
                                         src="{{str_replace('public','/storage',$product->image)}}"
                                         title="{{$product->title}}" alt="{{$product->title}}"
                                         data-zoom-image="{{str_replace('public','/storage',$product->image)}}" width="400" />
                                </div>
                                <div class="center-block text-center">
                                    <span class="zoom-gallery">
                                        <i class="fa fa-search">
                                        </i> برای مشاهده گالری روی تصویر کلیک کنید</span>
                                </div>
                                <div class="image-additional" id="gallery_01">
                                    <a class="thumbnail" href="#"
                                       data-zoom-image="{{str_replace('public','/storage',$product->image)}}"
                                       data-image="{{str_replace('public','/storage',$product->image)}} "
                                       title="{{$product->title}}">
                                       <img src="{{str_replace('public','/storage',$product->image)}}"
                                       title="{{$product->title}}" alt = "{{$product->title}}" />
                                    </a>
                                    @foreach($product->gallery as $pics)
                                    <a class="thumbnail" href="#"
                                       data-zoom-image="{{str_replace('public','/storage',$pics->address)}}"
                                       data-image="{{str_replace('public','/storage',$pics->address)}}"
                                       title="{{$pics->address}}">
                                        <img src="{{str_replace('public','/storage',$pics->address)}}"
                                             title="{{$pics->address}}" alt="{{$pics->address}}"  /></a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled description">
                                    <li><b>برند :</b> <a href="#"><span itemprop="brand">{{$product->brand->title}}</span></a></li>
                                    <li><b>کد محصول :</b> <span itemprop="mpn">محصولات 17</span></li>
                                    <li><b>امتیازات خرید:</b> 700</li>
                                    <li><b>وضعیت موجودی :</b> <span class="instock">موجود</span></li>
                                </ul>
                                <ul class="price-box">
                                    <li class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        @if($product->discount()->exists())
                                        <span class="price-old">{{$product->price}}  تومان</span>
                                        <span itemprop="price">{{$product->final_price()}}  تومان
                                            <span itemprop="availability" content="موجود"></span>
                                        </span>
                                        @else
                                            <span itemprop="price">{{$product->final_price()}}  تومان
                                            <span itemprop="availability" content="موجود"></span>
                                        </span>
                                        @endif
                                    </li>

                                </ul>
                                <div id="product">
                                    <h3 class="subtitle">انتخاب های در دسترس</h3>
                                    <div class="form-group required">
                                        <label class="control-label">رنگ</label>
                                        <select class="form-control" id="input-option200" name="option[200]">
                                            <option value=""> --- لطفا انتخاب کنید --- </option>
                                            <option value="4">مشکی </option>
                                            <option value="3">نقره ای </option>
                                            <option value="1">سبز </option>
                                            <option value="2">آبی </option>
                                        </select>
                                    </div>
                                    <div class="cart">
                                        <div>
                                            @if($product->cart_chk())
                                                <form action="{{Route("cart.update",$product)}}" method="post">
                                                    @csrf
                                                    @method("patch")
                                                    <div class="qty">
                                                        <label class="control-label" for="input-quantity">تعداد</label>
                                                        <input type="text" name="amount" value="1" size="2" id="input-quantity" class="form-control" />
                                                        <a class="qtyBtn plus" href="javascript:void(0);">+</a><br />
                                                        <a class="qtyBtn mines" href="javascript:void(0);">-</a>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <button  class="btn btn-primary btn-lg">
                                                        افزودن به سبد خرید
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{Route("cart.store",$product)}}" method="post">
                                                    @csrf
                                                    <div class="qty">
                                                        <label class="control-label" for="input-quantity">تعداد</label>
                                                        <input type="text" name="amount" value="1" size="2" id="input-quantity" class="form-control" />
                                                        <a class="qtyBtn plus" href="javascript:void(0);">+</a><br />
                                                        <a class="qtyBtn mines" href="javascript:void(0);">-</a>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <input type="text" value="{{$product->id}}" name="product_id" hidden>
                                                    <button  class="btn btn-primary btn-lg">
                                                        افزودن به سبد خرید
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        @auth()
                                        <div>
                                            @if($product->like_chk())
                                                <form action="{{Route("unlike",$product)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="wishlist"><i class="fa fa-heart like"></i>
                                                        افزودن به علاقه مندی ها
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{Route("like",$product)}}" method="post">
                                                    @csrf
                                                    <input type="text" value="{{$product->id}}" name="like" hidden>
                                                    <button class="wishlist"><i class="fa fa-heart"></i>
                                                        افزودن به علاقه مندی ها
                                                    </button>
                                                </form>
                                            @endif
                                            <br />
                                            <button type="button" class="wishlist" onClick=""><i class="fa fa-exchange"></i> مقایسه این محصول</button>
                                        </div>
                                        @endauth
                                    </div>
                                </div>
                                <div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                    <meta itemprop="ratingValue" content="0" />
                                    <p><span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span> <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href=""><span itemprop="reviewCount">1 بررسی</span></a> / <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href="">یک بررسی بنویسید</a></p>
                                </div>
                                <hr>
                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_toolbox addthis_default_style"> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal" pi:pinit:url="http://www.addthis.com/features/pinterest" pi:pinit:media="http://www.addthis.com/cms-content/images/features/pinterest-lg.png"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-514863386b357649"></script>
                                <!-- AddThis Button END -->
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-description" data-toggle="tab">توضیحات</a></li>
                            <li><a href="#tab-specification" data-toggle="tab">مشخصات</a></li>
                            <li><a href="#tab-review" data-toggle="tab">بررسی ({{$product->comments->count()}})</a></li>
                        </ul>
                        <div class="tab-content">
                            <div itemprop="description" id="tab-description" class="tab-pane active">
                                <div>
                                    <p>{{$product->description}}</p>
                                </div>
                            </div>
                            <div id="tab-specification" class="tab-pane">
                                <div id="tab-specification" class="tab-pane">
                                    @foreach($property_g as $prop)
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td colspan="2"><strong>{{$prop->title}}</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($prop->properties as $prop2)
                                            <tr>
                                                <td>{{$prop2->title}}</td>
                                                <td>{{$prop2->default_content($product)}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @endforeach
                                </div>
                            </div>
                            <div id="tab-review" class="tab-pane">

                                    <div id="review">
                                        <div>
                                            @foreach($product->comments()->latest()->get() as $comment)
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td style="width: 50%;"><strong><span>{{$comment->user->name}}</span></strong></td>
                                                    <td class="text-right"><span>{{$comment->created_at->format("Y/m/d")}}</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><p>{{$comment->content}}</p>
                                                        <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            @endforeach
                                        </div>
                                        <div class="text-right"></div>
                                    </div>
                                @can("comment_create", \App\Models\Comment::class )
                                    <h2>یک بررسی بنویسید</h2>
                                    <div class="form-group required">
                                        <div class="col-sm-12">

                                            <form class="form-horizontal" action="{{Route("product.comment.store",$product)}}" method="post">
                                                @csrf
                                                <label for="input-review" class="control-label">بررسی شما</label>
                                                <textarea class="form-control" id="input-review" rows="5" name="content"></textarea>
                                                <button class="btn btn-primary" >ادامه</button>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-12">
                                            <label class="control-label">رتبه</label>
                                            &nbsp;&nbsp;&nbsp; بد&nbsp;
                                            <input type="radio" value="1" name="rating">
                                            &nbsp;
                                            <input type="radio" value="2" name="rating">
                                            &nbsp;
                                            <input type="radio" value="3" name="rating">
                                            &nbsp;
                                            <input type="radio" value="4" name="rating">
                                            &nbsp;
                                            <input type="radio" value="5" name="rating">
                                            &nbsp;خوب</div>
                                    </div>
                                    <div class="buttons">
                                        <div class="pull-right">

                                        </div>
                                    </div>
                                @else
                                    <p>برای ارسال دیدگاه ابتدا باید <a href="{{Route("login")}}">وارد شوید</a></p>
                                @endcan


                            </div>
                        </div>
                        <h3 class="subtitle">محصولات مرتبط</h3>

                        <div class="owl-carousel related_pro">
                            <div class="product-thumb">
                                <div class="image"><a href="product.html"><img src="image/product/samsung_tab_1-220x330.jpg" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" /></a></div>
                                <div class="caption">
                                    <h4><a href="product.html">تبلت ایسر</a></h4>
                                    <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                                </div>
                                <div class="button-group">
                                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                                    <div class="add-to-links">
                                        <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                        <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--Middle Part End -->
                <!--Right Part Start -->
                <aside id="column-right" class="col-sm-3 hidden-xs">
                    <h3 class="subtitle">پرفروش ها</h3>
                    <div class="side-item">
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="image/product/apple_cinema_30-50x75.jpg" alt="تی شرت کتان مردانه" title="تی شرت کتان مردانه" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">تی شرت کتان مردانه</a></h4>
                                <p class="price"><span class="price-new">110000 تومان</span> <span class="price-old">122000 تومان</span> <span class="saving">-10%</span></p>
                            </div>
                        </div>
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="image/product/iphone_1-50x75.jpg" alt="آیفون 7" title="آیفون 7" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">آیفون 7</a></h4>
                                <p class="price"> 2200000 تومان </p>
                                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span></div>
                            </div>
                        </div>
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="image/product/macbook_1-50x75.jpg" alt="آیدیا پد یوگا" title="آیدیا پد یوگا" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">آیدیا پد یوگا</a></h4>
                                <p class="price"> 900000 تومان </p>
                                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                            </div>
                        </div>
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="image/product/sony_vaio_1-50x75.jpg" alt="کفش راحتی مردانه" title="کفش راحتی مردانه" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">کفش راحتی مردانه</a></h4>
                                <p class="price"> <span class="price-new">32000 تومان</span> <span class="price-old">12  تومان</span> <span class="saving">-25%</span> </p>
                                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                            </div>
                        </div>
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="image/product/FinePix-Long-Zoom-Camera-50x75.jpg" alt="دوربین فاین پیکس" title="دوربین فاین پیکس" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">دوربین فاین پیکس</a></h4>
                                <p class="price">122000 تومان</p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group">
                        <h3 class="subtitle">محتوای سفارشی</h3>
                        <p>این یک بلاک محتواست. هر نوع محتوایی شامل html، نوشته یا تصویر را میتوانید در آن قرار دهید. </p>
                        <p> در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. </p>
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                    </div>
                    <h3 class="subtitle">ویژه</h3>
                    <div class="side-item">
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="image/product/macbook_pro_1-50x75.jpg" alt=" کتاب آموزش باغبانی " title=" کتاب آموزش باغبانی " class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">کتاب آموزش باغبانی</a></h4>
                                <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">120000 تومان</span> <span class="saving">-26%</span> </p>
                            </div>
                        </div>
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="image/product/samsung_tab_1-50x75.jpg" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">تبلت ایسر</a></h4>
                                <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                            </div>
                        </div>
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="image/product/apple_cinema_30-50x75.jpg" alt="تی شرت کتان مردانه" title="تی شرت کتان مردانه" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="http://demo.harnishdesign.net/opencart/marketshop/v1/index.php?route=product/product&amp;product_id=42">تی شرت کتان مردانه</a></h4>
                                <p class="price"> <span class="price-new">110000 تومان</span> <span class="price-old">122000 تومان</span> <span class="saving">-10%</span> </p>
                            </div>
                        </div>
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="image/product/nikon_d300_1-50x75.jpg" alt="دوربین دیجیتال حرفه ای" title="دوربین دیجیتال حرفه ای" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">دوربین دیجیتال حرفه ای</a></h4>
                                <p class="price"> <span class="price-new">92000 تومان</span> <span class="price-old">98000 تومان</span> <span class="saving">-6%</span> </p>
                            </div>
                        </div>
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="image/product/nikon_d300_5-50x75.jpg" alt="محصولات مراقبت از مو" title="محصولات مراقبت از مو" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">محصولات مراقبت از مو</a></h4>
                                <p class="price"> <span class="price-new">66000 تومان</span> <span class="price-old">90000 تومان</span> <span class="saving">-27%</span> </p>
                                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                            </div>
                        </div>
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="image/product/macbook_air_1-50x75.jpg" alt="لپ تاپ ایلین ور" title="لپ تاپ ایلین ور" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">لپ تاپ ایلین ور</a></h4>
                                <p class="price"> <span class="price-new">10  تومان</span> <span class="price-old">12  تومان</span> <span class="saving">-5%</span> </p>
                            </div>
                        </div>
                    </div>
                </aside>
                <!--Right Part End -->
            </div>
        </div>
    </div>
@endsection
