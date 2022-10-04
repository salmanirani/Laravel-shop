<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Http\Requests\BrandRequest;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $brands = Brand::paginate('10');

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $brand = new Brand();
        $brand->title = $request->input('title');
        $brand->description = $request->input('description');
        $brand->photo_id = $request->input('photo_id');
        $brand->save();
        Session::flash('add_category', 'برند با موفقیت ایجاد شد');
        return redirect('admin/brands');
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand= Brand::with('photo')
            ->whereId($id)
            ->first();
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->title = $request->input('title');
        $brand->description = $request->input('description');
        $brand->photo_id = $request->input('photo_id');
        $brand->save();
        Session::flash('add_category', 'برند با موفقیت ویرایش شد');
        return redirect('admin/brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::whereId($id)->first();;
       unlink('./' . $brand->photo->path);
        $brand->delete();
        Session::flash('category_delete', 'برند با موفقیت حذف شد');
        return redirect('admin/brands');
    }
}
