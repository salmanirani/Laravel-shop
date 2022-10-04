<?php

namespace App\Http\Controllers\Backend;

use App\Product;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $products = Product::with('mtcategories', 'photos', 'shop', 'warehouses', 'orders')->where('user_id', Auth::id())->orderBy('id', 'desc')->paginate('10');
                return view('admin.warehouses.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Warehouse::with('product.warehouses')->orderBy('id', 'desc')->paginate('10');
        return view('admin.warehouses.list', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

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
//        dd($request->all());
        $newWarehouse = new Warehouse();
        $newWarehouse->inventory = $request->number;
        $newWarehouse->product_id = $id;
        $newWarehouse->status = $request->type;
        $newWarehouse->user_id = Auth::id();

        $newWarehouse->save();
        Session::flash('add_post', 'موجودی با موفقیت اضافه شد.');
        return redirect('/admin/warehouse');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
