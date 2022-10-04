<?php

namespace App\Http\Controllers\Frontend;

use App\Order;
use App\Payment;
use App\Sizecolor;
use App\SizeColorCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function verify(Request $request, $id)
    {

        $cart = Order::where('id', $id)->first();
        $payment = new Payment($cart->amount);
        $result = $payment->verifyPayment($request->Authority, $request->Status);


        if ($result['Status'] == '100') {
            $order = Order::with('products')->where('id', $id)->first();
            $order->status = 1;
            $order->save();
                //کم کردن موجودی سایز ها
            //inventory در sizecolors
            $inventory = '';
            $sizecolorcarts = SizeColorCart::where('coderahgiri',Session::get('coderahgiri'))->get();
            foreach($sizecolorcarts as $value){


                if(!empty($value->sizeid)) {
                    $fetch = Sizecolor::where('id', $value->sizeid)->first();
                    $inventory = intval($fetch->inventory) - intval(1);
                    $update = Sizecolor::findOrFail($value->sizeid);
                    $update->inventory = $inventory;
                    $update->save();
                }
            }

            $newPayment = new Payment($cart->amount);
            $newPayment->authority = $request->Authority;
            $newPayment->status = $request->Status;
            $newPayment->RefID = $result['RefID'];
            $newPayment->order_id = $id;
            $newPayment->save();
            //Session::forget('cart');
            //کدرهگیری صفر شود

            Session::flash('success', 'پرداخت شما با موفقیت انجام شد - کدرهگیری : ' . $result['RefID']);
            $coderahgiri = rand('99999','999898999');
            Session::put('coderahgiri', $coderahgiri);
            return redirect('/profile');
        } else {
            Session::flash('warning', $result['Message']);
            return redirect('/cart');
        }
    }
}
