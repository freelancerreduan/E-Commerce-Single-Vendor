<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tag;
use Carbon\Carbon;

class TagController extends Controller
{
    //Tag Controller
    function add_tag(){
        $tag_list = Tag::all();
        return view('backend/tag/tag',[
            'tag_list' => $tag_list,
        ]);
    }

    // Store Tag in database
    function store_tag(Request $request){
        Tag::insert([
            'tag_name' => $request->tag_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success','Tag Created Successfully');
    }

    // Tag Deleted
    function tag_delete($id){
        $tag_deleted = Tag::find($id)->delete();
        return back()->with('delete','Deleted');
    }
}
