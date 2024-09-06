@extends("client.layout.master")
@section("main_content")
    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li><a href="{{Route("shop_home")}}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{Route("login")}}">حساب کاربری</a></li>
                <li><a href="{{Route("register.create")}}">ثبت نام</a></li>
            </ul>
            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div class="col-sm-7" id="content">
                    <h3 class="title">یک ایمیل حاوی کلمه عبور به پست الکترونیکی شما ارسال شد</h3>
                    <p>اگر قبلا حساب کاربریتان را ایجاد کرد اید جهت ورود به <a href="{{Route("login")}}">صفحه لاگین</a> مراجعه کنید.</p>
                    <form class="form-horizontal" method="post" action="{{Route("register.verify",$user)}}">
                        @csrf
                        <fieldset id="account">

                            <div style="display: none;" class="form-group required">
                                <label class="col-sm-2 control-label">گروه مشتری</label>
                                <div class="col-sm-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" checked="checked" value="1" name="customer_group_id">
                                            پیشفرض</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="input-firstname" class="col-sm-2 control-label">کد ورود</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-firstname" placeholder="کد ورود خود را وارد کنید" value="" name="password">
                                </div>
                            </div>
                            <div class="buttons">
                                <div class="pull-right">
                                    <input type="submit" class="btn btn-primary" value="ثبت نام">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    @if(count($errors->all())>0)
                        <div class="alert alert-danger text-center">
                            @foreach($errors->all() as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
                <!--Middle Part End -->
                <!--Right Part Start -->

                <!--Right Part End -->
            </div>
        </div>
    </div>
@endsection
