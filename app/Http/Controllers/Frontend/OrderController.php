<?php

namespace App\Http\Controllers\Frontend;

use App\Address;
use App\Carts;
use App\Domain;
use App\Order;
use App\Payment;
use App\Postal;
use App\Product;
use App\Shop;
use App\Sizecolor;
use App\SizeColorCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function verify(Request $request)
    {
        $postal = $request->postal;
        $note = $request->note;
        $cart = Carts::where('coderahgiri', Session::get('coderahgiri'))->get();
        if (!$cart) {
            Session::flash('warning', 'سبد خرید شما خالی است');
            return redirect('/');
        }
        $productsId= [];
//price
        $sumprize = '';
        foreach ($cart as $products) {
            $product = Product::where('id',$products->product_id)->first();
            $qty = count(SizeColorCart::where('coderahgiri', Session::get('coderahgiri'))->where('product_id', $products->product_id)->get());
            array_push($productsId,$products->product_id);
            $productsId[$products->product_id] = ['qty' => $qty];
            $sumprize = intval($sumprize) + intval($product->discount_price ? $product->discount_price * $qty : $product->price * $qty);
        }
        $order = new Order();
        $order->amount = $sumprize;
        $order->user_id = Auth::user()->id;
        $order->status = 0;
        $order->note = $note;
        $order->postal = $postal;
        $order->coderahgiri = Session::get('coderahgiri');
        $order->save();
        $order->products()->sync($productsId);

        $payment = new Payment($order->amount, $order->id);
        $payment->doPayment();

    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(10);
        return view('frontend.profile.orders', compact(['orders']));

    }

    public function getOrderLists($id)
    {
        $client = new \GuzzleHttp\Client();
        $getHost = request()->getHost();
        $getHost2 = request()->getSchemeAndHttpHost();
        if ($getHost == 'localhost:8000' or $getHost == 'localhost') {
            $shop = '2';
        } else {
            $domain = Domain::where('domain', $getHost)->first();
            if (empty($domain->id)) {
                $domain = Domain::where('domain', $getHost2)->first();
                if (empty($domain->id)) {
                    dd('دامنه به درستی تنظیم نشده است.بدون http و www هم وارد نمایید');
                }
            }
            $shop = $domain->shop_id;

        }
        $user = Auth::user();

        $order = Order::with('user.addresses.province', 'user.addresses.city', 'products')->whereId($id)->first();
        $postal = Postal::where('id', $order->postal)->first();
        $theme = Shop::where('id', $shop)->first();

        if ($theme->theme == 'theme1') {
            return view('frontend.profile.orderslist', compact(['order']));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.profile.orderslist', compact(['order','user']));
        }
    }

    public static function showText($id)
    {
        $sizeColor = Sizecolor::where('id', $id)->first();
        if ($sizeColor) {
            echo ' <span class="variations__tab-size" data-parent="variations"
                                                     ><button                                                         
                                                           class="color btn"
                                                            style="background-color: ' . $sizeColor->colors . '" >
                                                            ' . $sizeColor->size . '
                                                    
                                                </button>
                                                <br/>
                                                سایز
                                            ' . $sizeColor->size . '
                                        </span>';
        }
    }


}
