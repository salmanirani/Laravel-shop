<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboard extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','asc')->limit(5)->get();
        $users = User::orderBy('created_at','asc')->limit(5)->get();
        $photos = Photo::orderBy('created_at','desc')->limit(5)->get();
        $date = verta()->format('Y/n/j');
       // dd('ok');
        return view('admin.dashboard.index',compact(['posts','users','photos','date']));
    }
}
