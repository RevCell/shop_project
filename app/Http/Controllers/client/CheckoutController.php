<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Product;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;


class CheckoutController extends Controller
{
    public function create()
    {
        return view("client.checkout.create",
        [
            'cart'=>Cart::get_cart(),
            'total_price'=>Cart::get_totalprice(),
            'total_product'=>Cart::get_totalproduct()
        ]
        );
    }

    public function store(Request $request)
    {
        $chk=Checkout::query()->create(
            [
                'price'=>$request->get("price"),
                'address'=>$request->get("address"),
            ]
        );

        foreach (Cart::get_cart() as $pro)
        {
            $amount=$pro->cart_content->amount;
            $price=$pro->cart_content->product_price;
            $product_id=$pro->cart_content->product_id;
            $total_price=$amount * $price;

            $chk->checkout_detail()->create(
                [
                    'product_id'=>$product_id,
                    'unite_price'=>$price,
                    'item_amount'=>$amount,
                    'total_price'=>$total_price
                ]
            );

        }

        Cart::query()->delete();

        $invoice= (new Invoice)->amount($chk->price);
        return Payment::purchase($invoice,function ($driver,$transactionID)use ($chk)
        {
            $chk->update(
                [
                    'transaction_id'=>$transactionID
                ]
            );
        })->pay()->render();

        //return redirect(Route("shop_home"));


    }

    public function payment_report(Request $request)
    {
        $chk=Checkout::query()->where("transaction_id",$request->get("Authority"))->first();
        $chk->update(
            [
                'checkout_status'=>$request->get("Status")
            ]
        );

        return redirect(Route("checkout.report",$chk));
    }

    public function show(Checkout $checkout)
    {
        return view("client.checkout.show",
        [
            'chk'=>$checkout
        ]);
    }
}
