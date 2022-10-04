<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Domain;
use App\Post;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class PostController extends Controller
{
    public function show($slug)
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

        $posts = Post::with(['user', 'photo'])
            ->where('slug', $slug)
            ->first();

        $last = Post::with('user', 'category', 'photo')
            ->where('status', 1)
            ->where('shop_id', $shop)
            ->orderBy('created_at', 'desc')
            ->paginate('6');
//return $posts[0]['blog'];
        $relatedProducts = Product::with('mtcategories','photos')->whereHas('shop', function ($subQuery) use ($shop) {
            $subQuery->where('id', $shop);
        })->limit(5)->get();
        $theme = Shop::where('id', $shop)->first();
        if ($theme->theme == 'theme1') {

            return view('frontend.blogs.post', compact('posts','last','relatedProducts'));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.blogs.post', compact('posts','last','relatedProducts'));
        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }

    }



    public function serachPosts()
    {
//        $shop = '2';
//
//        $client = new \GuzzleHttp\Client();
//
//        $query = Input::get('title');
//        //  dd($query);
//        $responseBlog =$client->request('POST', 'https://www.ishopsaz.com/api/v1/blogs', [
//            'form_params' => [
//                'shop' => $shop,
//                'paginate' => '10',
//            ]
//        ]);
//        $json_blogs =  json_decode($responseBlog->getBody(), true);
//        $posts =$json_blogs['data'];
//        $responseBlog =$client->request('POST', 'https://www.ishopsaz.com/api/v1/blogs', [
//            'form_params' => [
//                'shop' => $shop,
//                'paginate' => '5',
//            ]
//        ]);
//        $json_blogs =  json_decode($responseBlog->getBody(), true);
//        $lastPost =$json_blogs['data'];
//        $responseBlogCategory =$client->request('POST', 'https://www.ishopsaz.com/api/v1/blogsCategories', [
//            'form_params' => [
//                'shop' => $shop,
//                'paginate' => '8',
//            ]
//        ]);
//        $json_blogs_categories =  json_decode($responseBlogCategory->getBody(), true);
//        $categories =$json_blogs_categories['data'];

//return $categories['0']['category']['title'];
//        return $posts[0]['blog']['photo']['path'];

        $getHost = request()->getHost();
        $getHost2 = request()->getSchemeAndHttpHost();


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
            $query = Input::get('title');
            $posts = Post::with('user', 'category', 'photo')
                ->where('title', 'like', '%' . $query . '%')
                ->where('status', 1)
                ->where('shop_id', $shop)
                ->orderBy('created_at', 'desc')
                ->paginate('10');
            $last = Post::with('user', 'category', 'photo')
                ->where('status', 1)
                ->where('shop_id', $shop)
                ->orderBy('created_at', 'desc')
                ->paginate('5');
        $categories = Category::where('shop_id', $shop)->get();
        $theme = Shop::where('id', $shop)->first();

        if ($theme->theme == 'theme1') {
            return view('frontend.blogs.search', compact('posts', 'categories', 'query', 'last'));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.blogs.search', compact('posts', 'categories', 'query', 'last'));
        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }

    }
    public function blogCat($query)
    {
        $getHost = request()->getHost();
        $getHost2 = request()->getSchemeAndHttpHost();


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
//            $query = $request->'category');
            $posts = Post::with('user', 'category', 'photo')
                ->where('category_id',  $query)
                ->where('status', 1)
                ->where('shop_id', $shop)
                ->orderBy('created_at', 'desc')
                ->paginate('10');
            $last = Post::with('user', 'category', 'photo')
                ->where('status', 1)
                ->where('shop_id', $shop)
                ->orderBy('created_at', 'desc')
                ->paginate('5');
            $categories = Category::where('shop_id', $shop)->get();
        $theme = Shop::where('id', $shop)->first();

        if ($theme->theme == 'theme1') {
            return view('frontend.blogs.catrgory', compact('posts', 'categories', 'query', 'last'));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.blogs.catrgory', compact('posts', 'categories', 'query', 'last'));
        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }


    }

}
