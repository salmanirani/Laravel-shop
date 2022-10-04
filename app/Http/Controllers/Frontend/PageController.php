<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Domain;
use App\Page;
use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function show($id)
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
        $post = Page::with(['user', 'photo'])
            ->where('id', $id)
            ->first();
//        return $post;
        $theme = Shop::where('id', $shop)->first();
        if ($theme->theme == 'theme1') {

            return view('frontend.blogs.pages', compact('post'));
        } elseif ($theme->theme == 'theme2') {
            return view('frontend.theme2.blogs.pages', compact('post'));
        } else {
            dd('قالب فروشگاه انتخاب نشده است');
        }
    }
}
