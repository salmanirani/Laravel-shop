<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SliderRequest;
use App\Shop;
use App\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd('ok');
        $shops = Slider::with('photo','shop')->where('user_id',Auth::id())->paginate('10');
        return view('admin.sliders.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $shops = Shop::where('user_id',Auth::id())->whereNotIn('id',function($query) {
//            $query->select('shop_id')->from('sliders');
//        })->get();
        $shops = Shop::where('user_id',Auth::id())->get();
//        dd($shops);
        return view('admin.sliders.create',compact('shops'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {

        $brand = new Slider();
        $brand->title = $request->input('title');
        $brand->short_desc = $request->input('short_desc');
        $brand->description = $request->input('description');
        $brand->status = $request->input('status');;
        $brand->photo_id = $request->input('photo_id');
        $brand->shop_id = $request->input('shop_id');
        $brand->user_id = Auth::id();

        $brand->save();
        Session::flash('add_category', 'اسلایدر با موفقیت ایجاد شد');
        return redirect('admin/sliders');
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
        $slider = Slider::with('photo','shop')->whereId($id)->first();

        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $id)
    {
        $brand = Slider::findOrFail($id);
        $brand->title = $request->input('title');
        $brand->short_desc = $request->input('short_desc');
        $brand->description = $request->input('description');
        $brand->status = $request->input('status');;
        $brand->photo_id = $request->input('photo_id');
        $brand->user_id = Auth::id();
        $brand->save();
        Session::flash('add_category', 'اسلایدر با موفقیت ویرایش شد');
        return redirect('admin/sliders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Slider::with('photo')->whereId($id)->first();;
        if($shop->photo){
            unlink('./' . $shop->photo->path);
        }
        $shop->delete();
        Session::flash('category_delete', 'اسلایدر با موفقیت حذف شد');
        return redirect('admin/sliders');
    }
}
