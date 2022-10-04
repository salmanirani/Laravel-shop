<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Category;
use App\Garanty;
use App\Http\Requests\ProductRequest;
use App\Mtcategory;
use App\Product;
use App\Shop;
use App\Sizecolor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return '';
//        $products = Product::paginate('10');
        $products = Product::with('mtcategories', 'photos', 'shop')->where('user_id', Auth::id())->orderBy('id', 'desc')->paginate('10');

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        $categories = Mtcategory::with('childrenReqursive')->where('parent_id', null)->get();
        $garanties = Garanty::all();
        $brands = Brand::all();
        $shops = Shop::Where('user_id', Auth::id())->get();
        return view('admin.products.create', compact(['brands', 'shops', 'garanties']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function generateSKU()
    {
        $number = mt_rand(1000, 99999);
        if ($this->checkSKU($number)) {
            return $this->generateSKU();
        }
        return (string)$number;
    }

    public function checkSKU($number)
    {
        return Product::where('sku', $number)->exists();
    }

    function makeSlug($string)
    {
        $string = strtolower($string);
        $string = str_replace(['؟', '?'], '', $string);
        return preg_replace('/\s+/u', '-', trim($string));
    }

    public function size(Request $request)
    {
        if ($request->ajax()) {
            $colorbox = '';
            $colorHex = '';
            $text = '';
            $sizeArray = explode(',', $request->size);

            foreach ($sizeArray as $value) {
                $colorArray = explode(':', $value);

                $reversed = array_reverse($colorArray);
                $colorHex = $reversed[0];
                $text = $colorArray[0];
                if (!empty($text)) {
                    $colorbox = $colorbox . '<button  class="btn btn-success" style="background-color: ' . $colorHex . '">' . $text . '</button>';
                }
            }
            $colorbox = $colorbox . '<br/><br/><button class="btn btn-warning" onclick="deleteColor()">حذف همه سایز و رنگ های انتخابی</button>';
            return $colorbox;
        }

    }

    public function store(ProductRequest $request)
    {


        $newProduct = new Product();
        $newProduct->title = $request->title;
        $newProduct->sku = $this->generateSKU();
        if (str_slug($request->slug)) {
            $newProduct->slug = str_slug($request->slug);

        } else {
            $newProduct->slug = str_slug($request->title);
        }

        $newProduct->status = $request->status;
        $newProduct->price = $request->price;
        $newProduct->discount_price = $request->discount_price;
        $newProduct->short_description = $request->short_description;
        $newProduct->long_description = $request->long_description;
        $newProduct->brand_id = $request->brand;
        $newProduct->meta_desc = $request->meta_desc;
        $newProduct->meta_title = $request->meta_title;
        $newProduct->meta_keywords = $request->meta_keywords;
        $newProduct->user_id = Auth::id();

        $newProduct->save();


        $categories = implode(',', $request->categories);

        $garanties = explode(',', $request->input('garanty_id')[0]);
        $attributes = explode(',', $request->input('attributes')[0]);
        $photos = explode(',', $request->input('photo_id')[0]);
        $newProduct->mtcategories()->sync($request->categories);
        $newProduct->shop()->sync($request->input('shop_id'));

        $newProduct->attributevalues()->sync($attributes);
        $newProduct->garanty()->sync($garanties);
        $newProduct->photos()->sync($photos);

        $sizecolor = explode(',', $request->sizeColorVal);

        foreach ($sizecolor as $value) {
            $colorArray = explode(':', $value);

            $reversed = array_reverse($colorArray);
            $colorHex = $reversed[0];
            $text = $colorArray[0];
            if (!empty($text)) {

                $newsizeColor = new Sizecolor();
                $newsizeColor->size = $text;
                $newsizeColor->colors = $colorHex;
                $newsizeColor->product_id = $newProduct->id;
                $newsizeColor->save();

            }
        }
        Session::flash('add_post', 'محصول با موفقیت اضافه شد.');
        return redirect('/admin/product');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::paginate('10');
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $garanties = Garanty::all();
        $brands = Brand::all();
        $shops = Shop::Where('user_id', Auth::id())->get();
        $sizeColorVal = '';

        $product = Product::with('attributevalues', 'brand', 'mtcategories', 'photos', 'shop', 'garanty', 'sizecolors')->whereId($id)->first();
//        return $product->sizecolors;
        return view('admin.products.edit', compact(['brands', 'shops', 'garanties', 'sizeColorVal', ['product']]));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
//                return $request->all();

        $product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->sku = $this->generateSKU();
        if (str_slug($request->slug)) {
            $product->slug = str_slug($request->slug);

        } else {
            $product->slug = str_slug($request->title);
        }
        //return $newProduct->slug;
        $product->status = $request->status;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->brand_id = $request->brand;
        $product->meta_desc = $request->meta_desc;
        $product->meta_title = $request->meta_title;
        $product->meta_keywords = $request->meta_keywords;
        $product->user_id = Auth::id();

        $product->save();
        $garanties = explode(',', $request->input('garanty_id')[0]);
        $categories = implode(',', $request->categories);
        $attributes = explode(',', $request->input('attributes')[0]);
        $photos = explode(',', $request->input('photo_id')[0]);
        $product->shop()->sync($request->shop_id);
        $product->mtcategories()->sync($request->categories);
        $product->attributeValues()->sync($attributes);
        $product->garanty()->sync($garanties);
        $product->photos()->sync($photos);

        $sizecolor = explode(',', $request->sizeColorVal);
        $deleteOldSizeColor = Sizecolor::where('product_id', $id);
        $deleteOldSizeColor->delete();
        if ($request->sizeColorVal) {
            foreach ($sizecolor as $value) {
                $colorArray = explode(':', $value);

                $reversed = array_reverse($colorArray);
                $colorHex = $reversed[0];
                $text = $colorArray[0];
                if (!empty($text)) {

                    $newsizeColor = new Sizecolor();
                    $newsizeColor->size = $text;
                    $newsizeColor->colors = $colorHex;
                    $newsizeColor->product_id = $id;
                    $newsizeColor->save();

                }
            }
        }
        Session::flash('add_post', 'محصول با موفقیت ویرایش شد.');
        return redirect('/admin/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        unlink('./' . $product->photos[0]->path);
        $product->delete();
        Session::flash('delete_post', 'محصول با موفقیت حذف شد.');
        return redirect('/admin/product');
    }
}
