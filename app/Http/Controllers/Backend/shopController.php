<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\ShopRequest;
use App\Photo;
use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class shopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::where('user_id',Auth::id())->paginate('10');
//        $users = Brand::with('photos')->whereId('photo_id')->all();

        return view('admin.shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shops.create');
    }
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        $photo = new Photo();
        $photo->name = $file->getClientOriginalName();
        $photo->path = $name;
        $photo->user_id = Auth::id();
        $photo->save();
        return response()->json([
            'photo_id' => $photo->id
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request)
    {
        $brand = new Shop();
        $brand->title = $request->input('title');
        $brand->phone = $request->input('phone');
        $brand->status = 1;
        $brand->photo_id = $request->input('photo_id');
        $brand->user_id = Auth::id();

        $brand->save();
        Session::flash('add_category', 'فروشگاه با موفقیت ایجاد شد');
        return redirect('admin/shop');
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
        $shop = Shop::with('photo')->whereId($id)->first();;
        return view('admin.shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, $id)
    {
        $brand = Shop::findOrFail($id);
        $brand->title = $request->input('title');
        $brand->phone = $request->input('phone');
        $brand->photo_id = $request->input('photo_id');

        $brand->save();
        Session::flash('add_category', 'فروشگاه با موفقیت ویرایش شد');
        return redirect('admin/shop');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::with('photo')->whereId($id)->first();;
        if($shop->photo){
        unlink('./'.$shop->photo->path);
        }
        $shop->delete();
        Session::flash('category_delete', 'فروشگاه با موفقیت حذف شد');
        return redirect('admin/shop');
    }
}
