<?php

namespace App\Http\Controllers\Backend;

use App\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = Map::with('user')->where('user_id', Auth::id())->paginate('10');
        return view('admin.maps.index', compact('maps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maps = Map::where('user_id', Auth::id())->get();

        return view('admin.maps.create', compact('maps'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->ajax()) {
            $map = new Map();
            $map->title = $request->title;
            $map->price = $request->price;
            $map->latlong = $request->shape_for_db;
            $map->user_id = Auth::id();
            $map->save();
            return $request->title;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function monitor()
    {

        $maps = Map::where('user_id', Auth::id())->get();

        return view('admin.maps.monitor', compact('maps'));
    }
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Map::whereId($id)->first();;
        $coupon->delete();
        Session::flash('map_delete', 'محدوده با موفقیت حذف شد');
        return redirect('admin/maps');
    }
}
