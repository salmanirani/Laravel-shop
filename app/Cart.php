<?php

namespace App;

use Illuminate\Support\Facades\Session;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $totalDiscountPrice = 0;
    public $totalPurePrice = 0;
    public $couponDiscount = 0;
    public $coupon = null;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->totalPurePrice = $oldCart->totalPurePrice;
            $this->totalDiscountPrice = $oldCart->totalDiscountPrice;
        }
    }

    public function add($item, $id, $size , $coderahgiri )
    {

        if($item->discount_price){
            $storedItem = ['qty'=> 0,'price' => $item->discount_price, 'item' => $item];
        }else{
            $storedItem = ['qty'=> 0, 'price' => $item->price, 'item' => $item];
        }
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $sizecolorcart = SizeColorCart::where('product_id',$id)->where('coderahgiri',Session::get('coderahgiri'))->get();
        $storedItem['qty']=count($sizecolorcart);
        if($item->discount_price){
            $storedItem['price'] = $item->discount_price * $storedItem['qty'];
            $this->totalPrice += $item->discount_price;
            $this->totalDiscountPrice += ($item->price - $item->discount_price);
        }else{
            $storedItem['price'] = $item->price * $storedItem['qty'];
            $this->totalPrice += $item->price;
        }
        $storedItem['coderahgiri'] = $coderahgiri;
        $storedItem['size'] = $size;
        $storedItem['shop'] = $item->shop;
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        if($item->discount_price) {
            $this->totalPurePrice += $item->discount_price;
        }else{
            $this->totalPurePrice += $item->price;

        }
    }

    public function remove($item, $id)
    {
        $sizecolorcart = SizeColorCart::where('product_id',$this->items[$id]['item']->id)->where('coderahgiri',$this->items[$id]['coderahgiri']);
        $sizecolorcart->delete();
        if($this->items){
            if(array_key_exists($id, $this->items)){
                if($item->discount_price){
                    $this->items[$id]['price'] -= $item->discount_price;
                    $this->totalPrice -= $item->discount_price;
                    $this->totalDiscountPrice -= ($item->price - $item->discount_price);
                }else{
                    $this->items[$id]['price'] -= $item->price;
                    $this->totalPrice -= $item->price;
                }
                $this->totalQty--;
                $this->totalPurePrice -= $item->price;
//                if($this->items[$id]['qty'] > 1){
//                    $this->items[$id]['qty']--;
//                }else{
                    unset($this->items[$id]);
//                }
            }

        }

    }

    public function addCoupon($coupon)
    {
        $couponData = ['price'=> $coupon->price, 'coupon' => $coupon];
        $this->coupon = $couponData;
        $this->totalPrice -= $couponData['price'];
        $this->couponDiscount += $couponData['price'];
    }
}
