<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\MedalRequest;
use App\Medal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MedalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Medal::with('photo')->where('user_id',Auth::id())->paginate('10');
        return view('admin.medals.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medals.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedalRequest $request)
    {
        $brand = new Medal();
        $brand->name = $request->input('name');
        $brand->description = $request->input('description');
        $brand->status = $request->input('status');;
        $brand->photo_id = $request->input('photo_id');
        $brand->user_id = Auth::id();

        $brand->save();
        Session::flash('add_category', 'مدال با موفقیت ایجاد شد');
        return redirect('admin/medals');
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
        $shop = Medal::with('photo')->whereId($id)->first();;
        return view('admin.medals.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MedalRequest $request, $id)
    {
        $brand = Medal::findOrFail($id);
        $brand->name = $request->input('name');
        $brand->description = $request->input('description');
        $brand->status = $request->input('status');;
        $brand->photo_id = $request->input('photo_id');
        $brand->save();
        Session::flash('add_category', 'lnhg با موفقیت ویرایش شد');
        return redirect('admin/medals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Medal::with('photo')->whereId($id)->first();;
        if($shop->photo){
            unlink(public_path() . $shop->photo->path);
        }
        $shop->delete();
        Session::flash('category_delete', 'مدال با موفقیت حذف شد');
        return redirect('admin/medals');
    }
}
