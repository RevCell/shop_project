@extends("client.layout.master")
@section("main_content")

    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            @if($chk->checkout_status == "OK")

                    <h1>پرداخت موفقیت آمیز بود</h1>
                    <a href="{{Route("shop_home")}}">جهت بازگشت به صفحه اصلی کلیک کنید</a>

            @else
            <h1>پرداخت ناموفق</h1>
                <a href="{{Route("shop_home")}}"><h4>جهت بازگشت به صفحه اصلی کلیک کنید</h4></a>

            @endif
        </div>
    </div>

@endsection
