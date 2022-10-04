<?php

namespace App\Http\Controllers\Backend;

use App\Garanty;
use App\Http\Requests\GarantyRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GarantyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $garanties = Garanty::paginate('10');
        return view('admin.garanties.index', compact('garanties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.garanties.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GarantyRequest $request)
    {
        $brand = new Garanty();
        $brand->title = $request->input('title');
        $brand->description = $request->input('description');
        $brand->photo_id = $request->input('photo_id');
        $brand->save();
        Session::flash('add_category', 'گارانتی با موفقیت ایجاد شد');
        return redirect('admin/garanty');
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
        $brand= Garanty::with('photo')
            ->whereId($id)
            ->first();
        return view('admin.garanties.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GarantyRequest $request, $id)
    {
        $brand = Garanty::findOrFail($id);
        $brand->title = $request->input('title');
        $brand->description = $request->input('description');
        $brand->photo_id = $request->input('photo_id');
        $brand->save();
        Session::flash('add_category', 'گارانتی با موفقیت ویرایش شد');
        return redirect('admin/garanty');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Garanty::whereId($id)->first();;
        unlink('./' . $brand->photo->path);
        $brand->delete();
        Session::flash('category_delete', 'گارانتی با موفقیت حذف شد');
        return redirect('admin/garanty');
    }
}
