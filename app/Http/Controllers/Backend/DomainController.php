<?php

namespace App\Http\Controllers\Backend;

use App\Domain;
use App\Http\Requests\DomainRequest;
use App\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = Domain::where('user_id',Auth::id())->get();
        return view('admin.domains.index',compact('domains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = Shop::where('user_id',Auth::id())->get();
        return view('admin.domains.create',compact('shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DomainRequest $request)
    {
        $brand = new Domain();
        $brand->title = $request->input('title');
        $brand->description = $request->input('description');
        $brand->domain = $request->input('domain');
        $brand->shop_id = $request->input('shop_id');
        $brand->user_id = Auth::id();
        $brand->save();
        Session::flash('add_category', 'دامنه با موفقیت ایجاد شد');
        return redirect('admin/domains');
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
        $setting= Domain::with('shop')
            ->whereId($id)
            ->first();
        return view('admin.domains.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DomainRequest $request, $id)
    {
        $setting = Domain::findOrFail($id);
        $setting->title = $request->input('title');
        $setting->description = $request->input('description');
        $setting->domain = $request->input('domain');
        $setting->user_id = Auth::id();
        $setting->save();
        Session::flash('add_category', 'دامنه با موفقیت ویرایش شد');
        return redirect('admin/domains');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Domain::whereId($id)->first();;
        $brand->delete();
        Session::flash('category_delete', 'دامنه با موفقیت حذف شد');
        return redirect('admin/domains');
    }
}
