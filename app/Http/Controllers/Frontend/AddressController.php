<?php

namespace App\Http\Controllers\Frontend;

use App\Address;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::with('user.addresses.province','user.addresses.city')
            ->where('user_id',Auth::id())
            ->get();
        return view('frontend.profile.address', compact(['addresses']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $address = new Address();
        $address->address = $request->input('address');
        $address->company = $request->input('company');
        $address->post_code = $request->input('post_code');
        $address->province_id = $request->input('province_id');
        $address->city_id = $request->input('city_id');
        $address->user_id = Auth::id();
        $address->save();
        Session::flash('success', 'آدرس با موفقیت ایجاد شد');
        return back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Address::whereId($id)->first();;
        $brand->delete();
        Session::flash('delete', 'آدرس با موفقیت حذف شد');
        return back();
    }
}
