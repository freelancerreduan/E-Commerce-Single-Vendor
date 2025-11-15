<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
class CategoryController extends Controller
{
    function add_category(){
        $categories = Category::all();
        return view('backend.category.category', compact('categories'));
    }

    function store_category(Request $request){
        $request->validate([
            'category_name' => ['required','unique:categories'],
            'category_img' => 'required',
        ]);

        $slug = strtolower(str_replace(' ','-',$request->category_name));
        $cat_img = $request->category_img;
        $extension = $cat_img->extension();
        $img_name = uniqid().'.'.$extension;
        
        // driver
        $manager = new ImageManager(new Driver());
        $image = $manager->read($cat_img);
        $image->save(public_path('uploads/category/'.$img_name));
        // database updated
        Category::insert([
            'category_name' => $request->category_name,
            'category_img' =>  $img_name,
            'category_slug' => $slug,
        ]);
        return back()->with('success','Category Added Success');
        

    }


    // Delete Category
    function category_delete($id){
       $category_img = Category::find($id)->category_img;
       $delete_from = public_path('uploads/category/'.$category_img);
       unlink($delete_from);
       Category::find($id)->delete();

       return back()->with('delete', 'Category Delete Success');

    }


    // Sub Category

    // add Sub Category
    function sub_category(){  
        $categories = Category::all(); 

        $sub = Subcategory::all();
        return view('backend.category.subcategory', [
            'categories' => $categories,
            'sub' => $sub,
        ]); 
    }

    // insert database sub category
    function store_subcategory(Request  $request){
        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'created_at' => Carbon::now() ,
        ]);
            return back()->with('success', 'Sub Category Add Successfully');
    }

    // Sub Category Deleted
    function subcategory_delete($id){
       $SubCategory =  Subcategory::find($id)->delete();
       return back()->with('delete','Sub Category Delete Success');
    }
}   
