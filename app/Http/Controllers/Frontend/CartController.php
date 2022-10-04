<?php

namespace App\Http\Controllers\Frontend;

use App\Address;
use App\Cart;
use App\Carts;
use App\Domain;
use App\Postal;
use App\Product;
use App\Shop;
use App\Sizecolor;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id , $size = 0, $coderahgiri = 0)
    {

        $product = Product::with('photos','shop')->whereId($id)->first();
        $size= Sizecolor::where('id',$size)->first();

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id ,$size,$coderahgiri);

        // $cart->add($garanty, '1');
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.cart');

        //return $this->getCart();
    }

    public function removeItem(Request $request, $id){
        $product = Product::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($product, $product->id);
        $request->session()->put('cart', $cart);
        return back();
    }

    public function getCart()
    {
        $getHost = request()->getHost();
        $getHost2 = request()->getSchemeAndHttpHost();
        if($getHost == 'localhost:8000' or $getHost=='localhost') {
            $shop = '2';
        }else{
            $domain = Domain::where('domain',$getHost)->first();
            if(empty($domain->id)){
                $domain = Domain::where('domain',$getHost2)->first();
                if(empty($domain->id)){
                    dd('دامنه به درستی تنظیم نشده است.بدون http و www هم وارد نمایید');
                }
            }
            $shop = $domain->shop_id;

        }
//        $cart = Session::has('cart') ? Session::get('cart') : null;
//        $size = Sizecolor::where('id',)->first();
//            dd($cart->items);
        $addresses = Address::where('user_id',Auth::id())->get();
        $postal = Postal::with('shop')->whereHas('shop', function($q) use($shop) {
            $q->where('id', $shop);
        })->get();
        $cart = Carts::where('coderahgiri',Session::get('coderahgiri'))->get();
        $sumprize = '';
        $theme = Shop::where('id', $shop)->first();
        if ($theme->theme == 'theme1') {
            return view('frontend.cart.index', compact(['cart','addresses','postal','sumprize']));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.cart.index', compact(['cart','addresses','postal','sumprize']));

        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }
    }
}
