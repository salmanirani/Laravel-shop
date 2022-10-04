<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use App\Http\Requests\AttributeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributesGroup = AttributeGroup::paginate('10');
        return view('admin.attribute.index', compact('attributesGroup'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attribute.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $attribute = new AttributeGroup();
        $attribute->title = $request->input('title');
        $attribute->type = $request->input('type');
        $attribute->save();
        Session::flash('add_category', 'ویژگی جدید با موفقیت ایجاد شد');
        return redirect('admin/attributes-group');
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
        $attributes = AttributeGroup::findOrFail($id);
        return view('admin.attribute.edit', compact([ 'attributes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $id)
    {
        $attributes = AttributeGroup::findOrFail($id);
        $attributes->title = $request->input('title');
        $attributes->type = $request->input('type');
        $attributes->save();
        Session::flash('add_category', 'ویژگی با موفقیت ویرایش شد');
        return redirect('admin/attributes-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributes = AttributeGroup::findOrFail($id);
        $attributes->delete();
        Session::flash('add_category', 'ویژگی با موفقیت حذف شد');
        return redirect('admin/attributes-group');
    }


    public function deleteAll(Request $request)
    {
        $attributes = AttributeGroup::findOrFail($request->checkBoxArray);
        foreach ($attributes as $attribute) {
            $attribute->delete();
        }
        Session::flash('add_category', 'ویژگی ها با موفقیت حذف شد');
        return redirect('admin/attributes-group');


    }
}
