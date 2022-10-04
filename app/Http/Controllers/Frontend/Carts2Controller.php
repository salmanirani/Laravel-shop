<?php

namespace App\Http\Controllers\Frontend;

use App\Carts;
use App\Product;
use App\SizeColorCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Carts2Controller extends Controller
{
    public function add($product_id)
    {
        $cart = new Carts();
        $cart->status = 'In order';
        $cart->product_id = $product_id;
        $cart->coderahgiri = Session::get('coderahgiri');
        if (Auth::id()) {
            $cart->user_id = Auth::id();
        }
        $cart->save();
        return redirect('cart');
    }

    public static function getBasketCount()
    {
        DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
        $cart = Carts::where('coderahgiri', Session::get('coderahgiri'))->groupBy('product_id')->get();
        return count($cart);

    }

    public static function getProduct($id)
    {
        $product = Product::with('photos', 'shop')->whereId($id)->first();
        return $product;

    }

    public static function qty($id)
    {
        $product = SizeColorCart::where('coderahgiri', Session::get('coderahgiri'))->where('product_id', $id)->get();
        return count($product);

    }
//    public static function getBasket()
//    {
//        $cart = Carts::where('coderahgiri',Session::get('coderahgiri'))->get();
//        return count($cart);
//
//    }

    public function removeItem(Request $request, $id)
    {
        Carts::where('product_id', $id)->where('coderahgiri', Session::get('coderahgiri'))->first()->delete();
        SizeColorCart::where('coderahgiri', Session::get('coderahgiri'))->where('product_id', $id)->getQuery()->delete();;
        return back();
    }

    public static function showBasket()
    {
        echo '<div class="dropdown-cart-products">';

        $sumprize = intval(0);
        $cart = Carts::where('coderahgiri', Session::get('coderahgiri'))->get();
        foreach ($cart as $value) {
            $product = Product::with('photos', 'shop')->whereId($value->product_id)->first();
            $qty = self::qty($value->product_id);
            $sumprize = intval($sumprize) + intval($product->discount_price ? $product->discount_price * $qty : $product->price * $qty);

            echo ' <div class="product">

                                        <div class="product-cart-details">

                                            <h4 class="product-title">
                                                <a href="' . route('product.single', $product->slug) . '">' . $product->title . '</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">' . $qty . ' x </span>
                                                ' . number_format($product->discount_price ? $product->discount_price : $product->price) . ' تومان
                                            </span>
                                        </div><!-- End .product-cart-details -->

                                        <figure class="product-image-container">
                                            <a href="' . route('product.single', $product->slug) . '" class="product-image">
                                                <img src="https://www.ishopsaz.com' . $product->photos[0]->path . '"
                                                     alt="محصول">
                                            </a>
                                        </figure>
                                        <a href="#" class="btn-remove" title="حذف محصول" onclick="event.preventDefault();
                                        document.getElementById(\'remove-cart-item_{{$productDet->id}}\').submit();"><i class="icon-close"></i></a>


                                <form id="remove-cart-item_{{$productDet->id}}"
                                      action="' . route('cart.remove2', $product->id) . '"
                                      method="post" style="display: none;">
                                      <meta name="csrf-token" content="' . csrf_token() . '">
                                     <input type="hidden" name="_token" id="token" value="' . csrf_token() . '">
                                </form>
                                        
                                </div>';

        }
        echo ' </div><!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>مجموع</span>

                                <span class="cart-total-price">' . number_format($sumprize) . ' تومان</span>
                            </div><!-- End .dropdown-cart-total -->';

    }
}
