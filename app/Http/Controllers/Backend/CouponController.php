<?php

namespace App\Http\Controllers\Backend;

use App\Coupon;
use App\Http\Requests\CopounRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::paginate('20');
        return view('admin.coupons.index', compact('coupons'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CopounRequest $request)
    {
        $coupon = new Coupon();
        $coupon->title = $request->input('title');
        $coupon->code = $request->input('code');
        $coupon->price = $request->input('price');
        $coupon->status = $request->input('status');
        $coupon->save();
        Session::flash('add_category', 'برند با موفقیت ایجاد شد');
        return redirect('admin/coupons');
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
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CopounRequest $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->title = $request->input('title');
        $coupon->code = $request->input('code');
        $coupon->price = $request->input('price');
        $coupon->status = $request->input('status');
        $coupon->save();
        Session::flash('add_category', 'کپن با موفقیت ویرایش شد');
        return redirect('admin/coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::whereId($id)->first();;
        $coupon->delete();
        Session::flash('category_delete', 'کپن با موفقیت حذف شد');
        return redirect('admin/coupons');
    }
}
