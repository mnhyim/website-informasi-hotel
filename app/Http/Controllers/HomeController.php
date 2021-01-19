<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use DB;

class HomeController extends Controller
{
    // Controller untuk halaman /

    public function index()
    {
        $hotels = Hotel::latest()->paginate(6);
        return view('home.index',compact('hotels'));
    }

    public function show($id)
    {
        $hotel = Hotel::find($id);
        $hotel->increment('click_counter');
        return view('home.show',compact('hotel'));
    }

    public function search(Request $request)
	{
        $hotels = DB::table('hotels')->where('name', 'like', "%".$request->search."%")->orWhere('description', 'like', "%".$request->search."%")->paginate(6);
		return view('home.index',compact('hotels'));
    }
}
