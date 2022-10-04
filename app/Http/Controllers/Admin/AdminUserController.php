<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        /*$users = User::all();*/
        $users = User::with('roles')->paginate(10);
        $counter = 1;
        return view('admin.users.index', compact(['users']))->withCounter($counter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        if ($file = $request->file('avatar')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = new Photo();
            $photo->name = $file->getClientOriginalName();
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo->save();
            $user->photo_id = $photo->id;
        }
//        $user->national_code = $request->input('national_code');
//        $user->phone = $request->input('phone');
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->status = $request->input('status');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $user->roles()->attach($request->input('rols'));

        $users = User::with('roles')->get();
        $counter = 1;
        Session::flash('add_user', 'کاربر با موفقیت ایجاد شد');

        return redirect('admin/adminuser');
//        return view('admin.users.index', compact(['users']))->withCounter($counter);;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.edit');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $var = User::findOrFail($id);
        $roles = Role::all();//('name','id');
        return view('admin.users.edit', compact(['var', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($file = $request->file('avatar')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = new Photo();
            $photo->name = $file->getClientOriginalName();
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo->save();
            $user->photo_id = $photo->id;
        }
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->status = $request->input('status');

        if (trim($request->input('password')) != "") {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        $user->roles()->sync($request->input('rols'));

        $users = User::with('roles')->get();
        $counter = 1;
        Session::flash('add_user', 'کاربر با موفقیت ویرایش شد');

        return redirect('admin/adminuser');
        //return view('admin.users.index', compact(['users']))->withCounter($counter);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (!empty($user->photo_id)) {
            $photo = Photo::findOrFail($user->photo_id);
            unlink(public_path() . $user->photo->path);
            $photo->delete();
           // dd($photo);
        }

        $user->delete();
        Session::flash('delete_user', 'کاربر با موفقیت حذف شد');
        return redirect('admin/adminuser');
    }


}
