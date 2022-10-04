<?php

namespace App\Http\Controllers\Frontend;

use App\AttributeGroup;
use App\AttributeValue;
use App\AttributevalueTemp;
use App\Brand;
use App\Domain;
use App\Mtcategory;
use App\Order;
use App\Pay;
use App\Photo;
use App\Postal;
use App\Product;
use App\Setting;
use App\Shop;
use App\Sizecolor;
use App\SizeColorCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function showBox(Request $request)
    {
        $sizeId =  $request->sizeId;
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

        $brand = new SizeColorCart();
        $brand->sizeid = $request->sizeId;
        $brand->coderahgiri = Session::get('coderahgiri');
        $brand->product_id =  $request->product_id;
        $brand->save();
        $sizecolorcart = SizeColorCart::where('product_id',$request->product_id)->where('coderahgiri',Session::get('coderahgiri'))->get();
        foreach($sizecolorcart as $value) {
            $size = Sizecolor::where('id', $value->sizeid)->first();
            echo ' شما سایز ' . $size->size . 'و رنگ  ' . '<button class="color btn"
                                                        style="background-color: ' . $size->colors . ';border-style: solid;border-color: black;border-width: 1px">
                    </button>' . ' را انتخاب کردید.'.'<br/>';
        }
    }

    public static  function loadsize($productid)
    {
        $sizecolorcart = SizeColorCart::where('product_id',$productid)->where('coderahgiri',Session::get('coderahgiri'))->get();
        foreach($sizecolorcart as $value) {
            $size = Sizecolor::where('id', $value->sizeid)->first();
            echo ' شما سایز ' . $size->size . 'و رنگ  ' . '<button class="color btn"
                                                        style="background-color: ' . $size->colors . ';border-style: solid;border-color: black;border-width: 1px">
                    </button>' . ' را انتخاب کردید.'.'<br/>';
        }
    }
    public function getProduct($sku)
    {
        $getHost = request()->getHost();
        $getHost2 = request()->getSchemeAndHttpHost();
        $getPathInfo = request()->getPathInfo();
        $demo = '';
        if ($getHost == 'ishopsazfa.ir' or $getHost == 'http://ishopsazfa.ir' or $getHost == 'www.ishopsazfa.ir' or $getHost == 'localhost' or $getHost == 'localhost:8000') {
            $title = str_replace("/", "", $getPathInfo);
            $path =explode('/',$getPathInfo);
            $path[1];
            if (!empty($path[1])) {
                $shopQ = Shop::where('title_en', $path[1])->first();
                if(empty($shopQ)){
                    dd('فروشگاهی با این نام یافت نشد');
                }else {
                    $shop = $shopQ->id;
                    $demo = $path[1];

                }
            }else {
                $shop = '2';
            }
        }  else {
            $domain = Domain::where('domain', $getHost)->first();
            if (empty($domain->id)) {
                $domain = Domain::where('domain', $getHost2)->first();
                if (empty($domain->id)) {
                    dd('دامنه به درستی تنظیم نشده است.بدون http و www هم وارد نمایید');
                }
            }
            $shop = $domain->shop_id;

        }
        //api function

//
        $client = new \GuzzleHttp\Client();
//        $responseProduct = $client->request('POST', 'https://www.ishopsaz.com/api/v1/productsSingle', [
//            'form_params' => [
//                'shop' => $shop,
//                'sku' => $sku,
//            ]
//        ]);
//        $product = json_decode($responseProduct->getBody(), true);
//
//

        $product = Product::with(['photos', 'attributevalues.attributeGroup', 'brand', 'mtcategories',
            'shop', 'sizecolors', 'garanty',
            'mtcomments' => function ($q) {
                $q->where('status', 1)->where('parent_id', null);
            }
        ])->where('slug', $sku)->first();

//        $responseDetailSelect = $client->request('POST', 'https://www.ishopsaz.com/api/v1/productsSingleDetail', [
//            'form_params' => [
//                'shop' => $shop,
//                'sku' => $sku,
//            ]
//        ]);
//        $detailSelect = json_decode($responseDetailSelect->getBody(), true);
        $detailSelect = array();
        $details = AttributevalueTemp::where('product_id', $product->id)->get();
        foreach ($details as $detail) {
            //$detail->attributevalue_id
            if ($detail->type != 'text') {
                $att_name = AttributeValue::with('attributegroup')->where('id', $detail->detailvalue)->get();
                array_push($detailSelect, $att_name[0]);
            }
        }

//        $responseDetailText = $client->request('POST', 'https://www.ishopsaz.com/api/v1/productsSingleDetailText', [
//            'form_params' => [
//                'shop' => $shop,
//                'sku' => $sku,
//            ]
//        ]);
//        $detailText = json_decode($responseDetailText->getBody(), true);
        $details = AttributevalueTemp::where('product_id', $product->id)->get();
        $detailText = array();
        foreach ($details as $detail) {
            //$detail->attributevalue_id
            if ($detail->type == 'text') {

                $att_name = AttributeGroup::where('id', $detail->attributevalue_id)->get();
                $sum = array('att' => $att_name, 'value' => $detail->detailvalue);
                array_push($detailText, $sum);

            }
        }
//        //related product
//        $relatedProduct = $client->request('POST', 'https://www.ishopsaz.com/api/v1/relatedProducts', [
//            'form_params' => [
//                'shop' => $shop,
//                'category_id' => $product->mtcategories[0]->id,
//            ]
//        ]);
//        $relatedProducts = json_decode($relatedProduct->getBody(), true);


//

        $relatedProducts = Product::with('mtcategories')->where('status','1')->whereHas('shop', function ($subQuery) use ($shop) {
            $subQuery->where('id', $shop);
        })->whereHas('mtcategories', function ($q) use ($product) {
//            $q->whereIn('mtcategories.id', [$product->mtcategories]);   //in ghesmat dar laravel 9 dorost kar nemikonad vali dar version haye ghabli dorost ast
        })->limit(5)->orderBy('id','desc')->get();


//        dd($relatedProducts);
        $settings = Setting::where('shop_id', $product->shop[0]->id)->get();
        $domains = Domain::where('shop_id', $product->shop[0]->id)->get();
        $countProduct = Product::with(['shop' => function ($q) use ($product) {
            $q->where('id', $product->shop[0]->id);
        }])->get();
        $sizeTable = '';
        if (!empty($product->sizeTable)) {
            $sizeTable = Photo::where('id', $product->sizeTable)->first();
        }

        $theme = Shop::where('id', $shop)->first();
        if ($theme->theme == 'theme1') {

            return view('frontend.products.index', compact(['product', 'relatedProducts', 'detailSelect', 'detailText', 'sizeTable']));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.products.index', compact(['product', 'relatedProducts', 'detailSelect', 'detailText', 'sizeTable']));
        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }
    }


    public function getProductByCategory($id, $page = 1)
    {
        $getHost = request()->getHost();
//        $getHost = request()->getHttpHost();
        $getHost2 = request()->getSchemeAndHttpHost();
        $getPathInfo = request()->getPathInfo();
        $demo = '';
        if ($getHost == 'ishopsazfa.ir' or $getHost == 'http://ishopsazfa.ir' or $getHost == 'www.ishopsazfa.ir' or $getHost == 'localhost' or $getHost == 'localhost:8000') {
            $title = str_replace("/", "", $getPathInfo);
            $path =explode('/',$getPathInfo);
            $path[1];
            if (!empty($path[1])) {
                $shopQ = Shop::where('title_en', $path[1])->first();
                if(empty($shopQ)){
                    dd('فروشگاهی با این نام یافت نشد');
                }else {
                    $shop = $shopQ->id;
                    $demo = $path[1];

                }
            }else {
                $shop = '2';
            }
        }  else {
            $domain = Domain::where('domain', $getHost)->first();
            if (empty($domain->id)) {
                $domain = Domain::where('domain', $getHost2)->first();
                if (empty($domain->id)) {
                    dd('دامنه به درستی تنظیم نشده است.بدون http و www هم وارد نمایید');
                }
            }
            $shop = $domain->shop_id;

        }
//        $client = new \GuzzleHttp\Client();
//        $responseProduct = $client->request('POST', 'https://www.ishopsaz.com/api/v1/getProductByCategory?page=' . $page, [
//            'form_params' => [
//                'shop' => $shop,
//                'category_id' => $id,
//                'paginate' => '10',
//            ]
//        ]);
//        $productsLog = json_decode($responseProduct->getBody(), true);
//        $products = $productsLog['data'];
        $category = Mtcategory::whereId($id)->first();
        $products = Product::with('photos', 'brand','shop')
            ->where('status','1')
            ->whereHas('mtcategories', function ($q) use ($category) {
            $q->where('id', $category->id);
        })->whereHas('shop', function ($q) use ($shop) {
            $q->where('id', $shop);
        })->orderBy('id', 'DESC')->paginate(8);
        $theme = Shop::where('id', $shop)->first();
        if ($theme->theme == 'theme1') {
            return view('frontend.categories.index', compact(['products','category']));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.categories.index', compact(['products','category']));

        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }
    }

    public function serachProducts(Request $request)
    {
        $getHost = request()->getHost();
//        $getHost = request()->getHttpHost();
        $getHost2 = request()->getSchemeAndHttpHost();
        $getPathInfo = request()->getPathInfo();
        $demo = '';
        if ($getHost == 'ishopsazfa.ir' or $getHost == 'http://ishopsazfa.ir' or $getHost == 'www.ishopsazfa.ir' or $getHost == 'localhost' or $getHost == 'localhost:8000') {
            $title = str_replace("/", "", $getPathInfo);
            $path =explode('/',$getPathInfo);
            $path[1];
            if (!empty($path[1])) {
                $shopQ = Shop::where('title_en', $path[1])->first();
                if(empty($shopQ)){
                    dd('فروشگاهی با این نام یافت نشد');
                }else {
                    $shop = $shopQ->id;
                    $demo = $path[1];

                }
            }else {
                $shop = '2';
            }
        }  else {
            $domain = Domain::where('domain', $getHost)->first();
            if (empty($domain->id)) {
                $domain = Domain::where('domain', $getHost2)->first();
                if (empty($domain->id)) {
                    dd('دامنه به درستی تنظیم نشده است.بدون http و www هم وارد نمایید');
                }
            }
            $shop = $domain->shop_id;

        }
        $search = $request->q;
        $products = Product::with('shop')->where('status','1')->whereHas('shop', function ($q) use ($shop) {
            $q->where('id', $shop);
        })->where('title', 'like', '%' . $search . '%')->orWhereHas('mtcategories', function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        })->paginate(10);
        $theme = Shop::where('id', $shop)->first();
        if ($theme->theme == 'theme1') {
            return view('frontend.categories.search', compact(['products', 'shop']));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.categories.search', compact(['products', 'shop']));

        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }

    }

    public function allProduct()
    {

        $getHost = request()->getHost();
//        $getHost = request()->getHttpHost();
        $getHost2 = request()->getSchemeAndHttpHost();
        $getPathInfo = request()->getPathInfo();
        $demo = '';
        if ($getHost == 'ishopsazfa.ir' or $getHost == 'http://ishopsazfa.ir' or $getHost == 'www.ishopsazfa.ir' or $getHost == 'localhost' or $getHost == 'localhost:8000') {
            $title = str_replace("/", "", $getPathInfo);
            $path =explode('/',$getPathInfo);
            $path[1];
            if (!empty($path[1])) {
                $shopQ = Shop::where('title_en', $path[1])->first();
                if(empty($shopQ)){
                    dd('فروشگاهی با این نام یافت نشد');
                }else {
                    $shop = $shopQ->id;
                    $demo = $path[1];

                }
            }else {
                $shop = '2';
            }
        }  else {
            $domain = Domain::where('domain', $getHost)->first();
            if (empty($domain->id)) {
                $domain = Domain::where('domain', $getHost2)->first();
                if (empty($domain->id)) {
                    dd('دامنه به درستی تنظیم نشده است.بدون http و www هم وارد نمایید');
                }
            }
            $shop = $domain->shop_id;

        }

        $products = Product::with('photos', 'brand','shop')->where('status','1')->whereHas('shop', function ($q) use ($shop) {
            $q->where('id', $shop);
        })->orderBy('id', 'DESC')->paginate(20);
        $theme = Shop::where('id', $shop)->first();
        if ($theme->theme == 'theme1') {
            return view('frontend.categories.all', compact(['products', 'shop']));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.categories.all', compact(['products', 'shop']));

        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }

    }

//    public function apiGetProduct($id){
//        $products = Product::with('photos')->whereHas('mtcategories', function($q) use($id){
//            $q->where('id', $id);
//        })->paginate(3);
//        $response =[
//            'products' => $products
//        ];
//        return response()->json($response, 200);
//    }
//    public function apiGetSortedProduct($id, $sort, $paginate){
//        $products = Product::with('photos')->whereHas('mtcategories', function($q) use($id){
//            $q->where('id', $id);
//        })
//            ->orderBy('price', $sort)
//            ->paginate($paginate);
//        $response =[
//            'products' => $products
//        ];
//        return response()->json($response, 200);
//    }
//    public function apiGetCategoryAttributes($id){
//        $attributeGroups = AttributeGroup::with('attributesValue')
//            ->whereHas('mtcategories', function($q) use ($id){
//                $q->where('category_id', $id);
//            })
//            ->get();
//        $response =[
//            'attributeGroups' => $attributeGroups
//        ];
//        return response()->json($response, 200);
//    }
//    public function apiGetFilterProducts($id,$sort, $paginate, $attributes){
//        $attributesArray = json_decode($attributes, true);
//        $products = Product::with('photos')
//            ->whereHas('mtcategories', function($q) use($id){
//                $q->where('id', $id);
//            })
//            ->whereHas('attributeValues', function($q) use ($attributesArray){
//                $q->whereIn('attributeValue_id', $attributesArray);
//            })
//            ->orderBy('price', $sort)
//            ->paginate($paginate);
//
//        $response =[
//            'products' => $products
//        ];
//        return response()->json($response, 200);
//    }
}
