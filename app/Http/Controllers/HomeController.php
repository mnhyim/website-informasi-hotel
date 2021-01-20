<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Comment;
use App\Models\Announcement;
use DB;

class HomeController extends Controller
{
    // Controller untuk halaman /

    public function index()
    {
        $hotels = Hotel::latest()->paginate(6);
        $announcement = Announcement::latest()->paginate(6);

        return view('home.index',compact('hotels','announcement'));
    }

    public function show($id)
    {
        $hotel = Hotel::find($id);
        $comments = Comment::where('hotel_id', $id)->latest()->paginate(3);
        
        $hotel->increment('click_counter');
        return view('home.show',compact('hotel','comments'));
    }

    public function search(Request $request)
	{
        $hotels = DB::table('hotels')->where('name', 'like', "%".$request->search."%")->orWhere('description', 'like', "%".$request->search."%")->paginate(6);
        $announcement = Announcement::latest()->paginate(6);
        return view('home.index',compact('hotels','announcement'));
    }
}
