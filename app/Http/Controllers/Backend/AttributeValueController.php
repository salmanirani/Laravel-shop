<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use App\AttributeValue;
use App\Http\Requests\AttributeValueRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributesGroup = AttributeValue::with('attributegroup')->paginate('10');
        return view('admin.attribute-value.index', compact('attributesGroup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributesGroup = AttributeGroup::all();
        return view('admin.attribute-value.create',compact('attributesGroup'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeValueRequest $request)
    {
        $attribute = new AttributeValue();
        $attribute->title = $request->input('title');
        $attribute->attributegroub_id = $request->input('attribute_group');
        $attribute->save();
        Session::flash('add_category', 'مقدار جدید با موفقیت ایجاد شد');
        return redirect('admin/attributes-value');
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
        $attributeValue = AttributeValue::with('attributegroup')->whereId($id)->first();
//return $attributeValue->title;
        $attributes = AttributeGroup::all();
        return view('admin.attribute-value.edit', compact([ 'attributeValue','attributes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeValueRequest $request, $id)
    {
        $attributes = AttributeValue::findOrFail($id);
        $attributes->title = $request->input('title');
        $attributes->attributegroub_id = $request->input('attribute_group');
        $attributes->save();
        Session::flash('add_category', 'مقدار با موفقیت ویرایش شد');
        return redirect('admin/attributes-value');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributes = AttributeValue::findOrFail($id);
        $attributes->delete();
        Session::flash('add_category', 'مقدار با موفقیت حذف شد');
        return redirect('admin/attributes-value');
    }
}
