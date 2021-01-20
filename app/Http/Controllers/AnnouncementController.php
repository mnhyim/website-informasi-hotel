<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Hotel;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    //
    public function store(Request $request)
    {
        // echo "masuk gan".$request->messages;
        $x = Hotel::where('owner_id', Auth::id())->first();

        
        $request->validate([
            'messages' => 'required',
        ]);

        $temp = $request->all();

        $temp['hotel_id'] = $x->id;
        Announcement::create($temp);
        return redirect()->route('dashboard.index')->with('success','Pesan anda telah di broadcast!.');
    }
}
