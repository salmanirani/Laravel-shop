<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SettingRequest;
use App\Setting;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings = Setting::with('shop')->where('user_id',Auth::id())->get();
        return view('admin.setting.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = Shop::where('user_id',Auth::id())->whereNotIn('id',function($query) {
            $query->select('shop_id')->from('settings');
        })->get();
        return view('admin.setting.create',compact('shops'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $brand = new Setting();
        $brand->enamad = $request->input('enamad');
        $brand->title = $request->input('title');
        $brand->description = $request->input('description');
        $brand->meta_description = $request->input('meta_description');
        $brand->meta_keywords = $request->input('meta_keywords');
        $brand->shop_id = $request->input('shop_id');
        $brand->user_id = Auth::id();
        $brand->save();
        Session::flash('add_category', 'تنظیمات با موفقیت ایجاد شد');
        return redirect('admin/settings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting= Setting::with('shop')
            ->whereId($id)
            ->first();
        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $setting->enamad = $request->input('enamad');
        $setting->title = $request->input('title');
        $setting->description = $request->input('description');
        $setting->meta_description = $request->input('meta_description');
        $setting->meta_keywords = $request->input('meta_keywords');
        $setting->save();
        Session::flash('add_category', 'تنظیمات با موفقیت ویرایش شد');
        return redirect('admin/settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Setting::whereId($id)->first();;
        $brand->delete();
        Session::flash('category_delete', 'تنظیمات با موفقیت حذف شد');
        return redirect('admin/settings');
    }

    public function profile()
    {
        $user = User::with('photo','addresses')->whereId(Auth::id())->first();
//        dd($user);
        return view('admin.profile.index',compact('user'));

    }
}
