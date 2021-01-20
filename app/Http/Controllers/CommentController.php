<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'comment' => 'required',
            'rate' => 'required',
        ]);

        Comment::create($request->all());
        return redirect()->route('home.show',$request->hotel_id);
    }
}
