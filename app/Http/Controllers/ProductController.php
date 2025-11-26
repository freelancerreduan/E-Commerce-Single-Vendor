<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\subcategory;
use App\Models\Tag;
use App\Models\Gallary;
use App\Models\Product;
use App\Models\Announsment;
use App\Models\Inventory;
use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    //Add Product
    function add_product(){
        $categories = Category::all();
        $sub_categories = Subcategory::all();
        $tags = Tag::all();
        return view('backend/product/product',[
            'categories' => $categories,
            'sub_categories' =>$sub_categories,
            'tags' =>$tags,
        ]);
    }

    // store Product in database
    function store_product(Request $request){
       
        // form validated 
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'tag_id' => 'required|array',
            'tag_id.*' => 'integer|exists:tags,id',
            'product_name' => 'required',
            'price' => 'required | numeric',
            'discount' => 'nullable | numeric',
            'short_des' => 'nullable | string',
            'long_des' => 'required',
            'Previous' => ' | image |mimes:jpg,png,jpeg',
        ]);

        $tag_id = implode(',',$request->tag_id);
        // making slug system
        $slug = strtolower(str_replace(' ','_', $request->product_name));
        $discount_price = $request->price - ($request->price * $request->discount / 100);
    
        $previous = $request->Previous;
        $extension = $previous->extension();
        $img_name = uniqid().'.'.$extension;
        
        // image driver
        $manager = new ImageManager(new Driver());
        $image = $manager->read($previous);
        $image->save(public_path('uploads/products/previews/'.$img_name));

        // insert in database
        $product_id = Product::insertGetID([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'tag_id' => $tag_id,
            'product_name' => $request->product_name,
            'slug' => $slug,
            'discount' => $request->discount,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'previous' => $img_name,
            'created_at' => Carbon::now(),
        ]);

        foreach($request->gallary as $gallary){

            $extension = $gallary->extension();
            $img_name = uniqid().'.'.$extension;
            // image driver
            $manager = new ImageManager(new Driver());
            $image = $manager->read($gallary);
            $image->save(public_path('uploads/products/gallary/'.$img_name));

            Gallary::insert([
                'product_id' => $product_id,
                'gallary' => $img_name,
            ]);
        }
        return back()->with('success','Product Added Successfully');
    }


    // Product List 
    function product_list(){
        $products = Product::all();
        return view('backend/product/product_list',[
            'products' => $products,
        ]);
    }

    // Product Edit
    function edit_product($id){
        $product = Product::find($id);
        return view('backend.product.edit',[
            'product' => $product,
        ]);
    }

    // Product Deleted 
    function product_delete($id){
        Product::find($id)->delete();
        return back()->with('success','Product Deleted Successfully');
    }

    // Product update 
    function product_update(Request $request){
        $product_id = Product::find($request->product_id);
        // validate for file formate file  size
        $request->validate([
            'previous' => 'mimes:jpg,jpeg,png',
            'previous' => 'file|max:1024',
        ]);

        if($request->previous){
            if($request->previous != null){
                $delete_img =public_path('uploads/products/previews/'.$product_id->previous );
                if(file_exists($delete_img)){
                    unlink($delete_img);
                }
            }
            // extention finded
            $previous = $request->previous;
            $extension = $previous->extension();
            $img_name = uniqid().'.'.$extension;
            
            // image package driver
            $manager = new ImageManager(new Driver());
            $image = $manager->read($previous);
            $image->save(public_path('uploads/products/previews/'.$img_name));

            // model for just text updated
            $product_id->update([
                'product_name' => $request->product_name,
                'price' => $request->price,
                'discount' => $request->discount,
                'previous' => $img_name,
            ]);

            return back()->with('success','Product Picture Updated');
        }
        else{
            Product::find($product_id)->update([
                'product_name' => $request->product_name,
                'price' => $request->price,
                'discount' => $request->discount,
            ]);
            return back()->with('success','Product Details Updated Successfully');
        }
    }



    // Product Inventory
    function product_inventory($id){
        $products = Product::find($id);
        $colors = Color::all();
        $sizes = Size::all();
        $inventories = Inventory::where('product_id', $id)->get();
        return view('backend.product.inventory',[
            'product' => $products ,
            'colors' => $colors,
            'sizes' => $sizes, 
            'inventories' => $inventories, 
        ]);
    }

    // Insert Inventory in database Add inventory
    function add_inventory(Request $request){
        $products_info = Product::find($request->product_id);
        $discount = $request->price - ($products_info->discount * $request->price / 100 );

       $request->validate([
            'color_id' => 'required|integer',
            'size_id'  => 'required|integer',
            'price'    => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        Inventory::insert([
            'product_id' => $products_info->id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'price' => $request->price,
            'discount_price' =>  $discount,
            'quantity' => $request->quantity,
        ]);                  

        return back()->with('success','Inventory Added Successfully');
    }


    // inventory Deleted
    function inventory_delete($id){
        Inventory::find($id)->delete();
        return back()->with('success','Deleted Successfully');
    }

    // Product Variant
    function product_variant(Request $request){
        $color_list = Color::all();
        $size_list = Size::all();
        return view('backend.product.variant',[
            'color_list' => $color_list,
            'size_list' => $size_list,
        ]);
    }


    // color add in database 
    function add_color(Request $request){
        Color::insert([
            'color_name'=> $request->color_name,
            'color_code' => $request->color_code,
        ]);
        return back()->with('success', 'Color added Successfully');
    }


    // Color Deleted 
    function color_delete ($id){
        $delete = Color::find($id)->delete();
        return back()->with('success','Color Deleted Successfully');
    }


    // Size add in database 
    function add_size(Request $request){
        Size::insert([
            'size_name'=> $request->size_name,
        ]);
        return back()->with('success', 'Size added Successfully');
    }

    // size deleted 
    function size_delete($id){
        $size_delete = Size::find($id)->delete();
        return back()->with('success','Size Deleted Successfully');
    }


    // Annousnment
    function add_announsment(){
        $announsment = Announsment::first();
        return view('backend.announcment.announcment', [
            'announsment' => $announsment,
        ]);
    }

    // store announsment
    function store_announsment(Request $request){

        $request->validate([
            'announsment' => 'required|string',
        ]);

        Announsment::first()->update([
            'announsment' => $request->announsment,
            'status' => $request->status,
        ]);
        
        return back()->with('success','Announsmetn Updated Successfully');
    }


}
