<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Domain;
use App\Mail\SampleMail;
use App\Order;
use App\Pay;
use App\Post;
use App\Product;
use App\Shop;
use App\Slider;
use App\Http\Controllers\Controller;
use http\Env\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{

    public function index()
    {
        $client = new \GuzzleHttp\Client();
        $getHost = request()->getHost();
//        $getHost = request()->getHttpHost();
        $getHost2 = request()->getSchemeAndHttpHost();

//        if(!empty(Session::get('shop'))){
//            $shop = Session::get('shop');
//        }
//        else
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
        $theme = Shop::where('id', $shop)->first();

        //slider api
//        $response = $client->request('POST', 'https://www.ishopsaz.com/api/v1/slider', [
//            'form_params' => [
//                'shop' => $shop,
//                'paginate' => '4',
//            ]
//        ]);
//        $json_sliders = json_decode($response->getBody(), true);
//        $sliders = $json_sliders['data'];
        $sliders = Slider::where('shop_id', $shop)->paginate('4');
        //  return $sliders;

        //latest product api
//        $latestProducts = $client->request('GET', 'https://www.ishopsaz.com/api/v1/products/' . $shop . '/10');
//        $json_products = json_decode($latestProducts->getBody(), true);
//        $latestProduct = $json_products['data'];
//        $latestProduct = Product::with('photos')->where('status','1') ->orderBy('id','desc')->whereHas('shop', function ($subQuery) use ($shop) {
//            $subQuery->where('id', $shop);
//        })->paginate(10);
        $latestProduct = Product::with('photos')->where('status', '1')->orderBy('id', 'desc')->whereHas('shop', function ($subQuery) use ($shop) {
            $subQuery->where('id', $shop);
        })
            // Order the cotnents
            ->latest()
            // Paginate the contents
            ->paginate(8);

        //most seller
        $mostSeller = Product::with('photos')->where('status', '1')->whereHas('orders', function ($subQuery) {
            $subQuery->where('status_orders', 'ارسال شده');
        })
            ->whereHas('shop', function ($subQuery) use ($shop) {
                $subQuery->where('id', $shop);
            })
            // Order the cotnents
            ->latest()
            ->orderBy('id', 'asc')
            // Paginate the contents
            ->paginate(10);
        //            ->inRandomOrder()
//dd($latestProduct[0]->photos[1]->path);
//        dd($latestProduct[0]['title']['images'][0]['path']);
        //last post with api
//        $responseBlog = $client->request('POST', 'https://www.ishopsaz.com/api/v1/blogs', [
//            'form_params' => [
//                'shop' => $shop,
//                'paginate' => '5',
//            ]
//        ]);
//        $json_blogs = json_decode($responseBlog->getBody(), true);
//        $posts = $json_blogs['data'];
        $trendingSell = Product::with('photos', 'wishlists')->where('status', '1')->where('trending', '1')
            ->whereHas('shop', function ($subQuery) use ($shop) {
                $subQuery->where('id', $shop);
            })
            // Order the cotnents
            ->latest()
            ->orderBy('id', 'asc')
            // Paginate the contents
            ->paginate(10);

//        dd($trendingSell[0]->wishlists[0]->id);
        $posts = Post::with('photo')->where('shop_id', $shop)->orderBy('created_at', 'desc')->limit(3)->get();

        if ($theme->theme == 'theme1') {
            return view('frontend.main.index', compact('latestProduct', 'sliders', 'posts', 'mostSeller'));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.main.index', compact('latestProduct', 'sliders', 'posts', 'mostSeller', 'trendingSell'));

        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }
    }


    public function blog()
    {
        $client = new \GuzzleHttp\Client();
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
        $posts = Post::with('user', 'category', 'photo')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate('5');
        $categories = Category::all();
        $theme = Shop::where('id', $shop)->first();

        if ($theme->theme == 'theme1') {
            return view('frontend.blogs.index', compact('posts', 'categories'));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.blogs.index', compact('posts', 'categories'));
        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }


    }

    public function services($id)
    {
        $client = new \GuzzleHttp\Client();
        $getHost = request()->getHost();
//        $getHost = request()->getHttpHost();
        $getHost2 = request()->getSchemeAndHttpHost();
        $getPathInfo = request()->getPathInfo();

       if ($getHost == 'ishopsazfa.ir' or $getHost == 'http://ishopsazfa.ir') {
            $shop = str_replace("/", "", $getPathInfo);
            Session::put('shop', $shop);

        } elseif ($getHost == 'localhost' or $getHost == 'localhost:8000') {
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



        //slider api
//        $response = $client->request('POST', 'https://www.ishopsaz.com/api/v1/slider', [
//            'form_params' => [
//                'shop' => $shop,
//                'paginate' => '4',
//            ]
//        ]);
//        $json_sliders = json_decode($response->getBody(), true);
//        $sliders = $json_sliders['data'];
        $sliders = Slider::where('shop_id', $shop)->paginate('4');
        //  return $sliders;

        //latest product api
//        $latestProducts = $client->request('GET', 'https://www.ishopsaz.com/api/v1/products/' . $shop . '/10');
//        $json_products = json_decode($latestProducts->getBody(), true);
//        $latestProduct = $json_products['data'];
//        $latestProduct = Product::with('photos')->where('status','1') ->orderBy('id','desc')->whereHas('shop', function ($subQuery) use ($shop) {
//            $subQuery->where('id', $shop);
//        })->paginate(10);
        $latestProduct = Product::with('photos')->where('status', '1')->orderBy('id', 'desc')->whereHas('shop', function ($subQuery) use ($shop) {
            $subQuery->where('id', $shop);
        })
            // Order the cotnents
            ->latest()
            // Paginate the contents
            ->paginate(8);

        //most seller
        $mostSeller = Product::with('photos')->where('status', '1')->whereHas('orders', function ($subQuery) {
            $subQuery->where('status_orders', 'ارسال شده');
        })
            ->whereHas('shop', function ($subQuery) use ($shop) {
                $subQuery->where('id', $shop);
            })
            // Order the cotnents
            ->latest()
            ->orderBy('id', 'asc')
            // Paginate the contents
            ->paginate(10);
        //            ->inRandomOrder()
//dd($latestProduct[0]->photos[1]->path);
//        dd($latestProduct[0]['title']['images'][0]['path']);
        //last post with api
//        $responseBlog = $client->request('POST', 'https://www.ishopsaz.com/api/v1/blogs', [
//            'form_params' => [
//                'shop' => $shop,
//                'paginate' => '5',
//            ]
//        ]);
//        $json_blogs = json_decode($responseBlog->getBody(), true);
//        $posts = $json_blogs['data'];
        $trendingSell = Product::with('photos', 'wishlists')->where('status', '1')->where('trending', '1')
            ->whereHas('shop', function ($subQuery) use ($shop) {
                $subQuery->where('id', $shop);
            })
            // Order the cotnents
            ->latest()
            ->orderBy('id', 'asc')
            // Paginate the contents
            ->paginate(10);

//        dd($trendingSell[0]->wishlists[0]->id);
        $posts = Post::with('photo')->where('shop_id', $shop)->orderBy('created_at', 'desc')->limit(3)->get();
        $theme = Shop::where('id', $shop)->first();

        if ($theme->theme == 'theme1') {
            return view('frontend.main.index', compact('latestProduct', 'sliders', 'posts', 'mostSeller'));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.main.index', compact('latestProduct', 'sliders', 'posts', 'mostSeller', 'trendingSell'));

        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }

    }
}
