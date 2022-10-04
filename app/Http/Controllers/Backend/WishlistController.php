<?php

namespace App\Http\Controllers\Backend;

use App\Domain;
use App\Http\Controllers\Controller;
use App\Wishlists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public static function addWishlist($product_id)
    {
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
        $cart = new Wishlists();
        $cart->product_id = $product_id;
        $cart->user_id = Auth::id();
        $cart->shop_id = $shop;
        $cart->save();
        return back();

    }
    public static function removeWishlist($id)
    {
        $wishlist = Wishlists::where('product_id',$id)->where('user_id',Auth::id())->delete();
        return back();
    }
    public static function getWishLists()
    {
       echo  $wishlist = Wishlists::where('user_id',Auth::id())->count();
    }

}
