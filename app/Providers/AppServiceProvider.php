<?php

namespace App\Providers;

use App\Carts;
use App\Category;
use App\Domain;
use App\Setting;
use App\Shop;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);
         $getHost = request()->getHost();
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
        }else {
            $domain = Domain::where('domain', $getHost)->first();
            if (empty($domain->id)) {
                $getHost2 = request()->getSchemeAndHttpHost();
                $domain = Domain::where('domain', $getHost2)->first();
                if (empty($domain->id)) {
                    dd('دامنه به درستی تنظیم نشده است.بدون http و www هم وارد نمایید');
                }
            }
            $shop = $domain->shop_id;
        }

        View::share('demo', $demo);

        $client = new \GuzzleHttp\Client();
        //category for all front page
        $categoryProducts = $client->request('POST', 'https://www.ishopsaz.com/api/v1/shopCategories', [
            'form_params' => [
                'shop' => $shop,

            ]
        ]);


        $categoryProduct = json_decode($categoryProducts->getBody(), true);
        View::share('mtcategories', $categoryProduct);

        //shop settings
//        $settings = $client->request('POST', 'https://www.ishopsaz.com/api/v1/getShopSetting', [
//            'form_params' => [
//                'shop' => $shop,
//
//            ]
//        ]);
//        $setting = json_decode($settings->getBody(), true);
        $setting = Setting::with('shop')->where('shop_id',$shop)->get();

        View::share('setting', $setting);

        //page for active shop
        $page = $client->request('POST', 'https://www.ishopsaz.com/api/v1/getPages', [
            'form_params' => [
                'shop' => $shop,

            ]
        ]);
        $pages = json_decode($page->getBody(), true);
        View::share('pages', $pages);


        $categoriesBlog = Category::where('shop_id', $shop)->get();
        View::share('categoriesBlog', $categoriesBlog);
        $theme = Shop::with('photo')->where('id', $shop)->first();
        View::share('theme', $theme->theme);
        if(empty($theme->photo->path)){
            View::share('logo', '');
        }else{
            View::share('logo', $theme->photo->path);
        }
        View::share('shopTable', $theme);

        if (empty($coderahgiri)) {
            $coderahgiri = rand('99999', '999898999');
            Session::put('coderahgiri', $coderahgiri);
        }

    }

}
