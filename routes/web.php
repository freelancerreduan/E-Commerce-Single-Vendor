<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Models\Tag;

Route::get('/', function () {
    return view('welcome');
});

// Route with Authentications Direct Linik Potections
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


    // Profile Update
    Route::get('/edit/profile',[UserController::class, 'edit_profile'])->name('edit.profile');
    Route::post('/update/profile',[UserController::class, 'update_profile'])->name('update.profile');
    Route::post('/update/password', [UserController::class, 'update_password'])->name('update.password');


    // Category Added 
    Route::get('add/category',[CategoryController::class , 'add_category'])->name('add.category');
    Route::post('store/category',[CategoryController::class , 'store_category'])->name('store.category');
    Route::get('/category/delete/{id}',[ CategoryController::class, 'category_delete'])->name('category.delete');


    // Sub Category Added
    Route::get('/add/subcategory', [CategoryController::class, 'sub_category'])->name('sub.category');
    Route::post('/store/subcategory', [CategoryController::class, 'store_subcategory'])->name('store.subcategory');
    Route::get('/subcategory/delete/{id}',[CategoryController::class, 'subcategory_delete'])->name('subcategory.delete');


    // Tag Genarate
    Route::get('/add/tag',[TagController::class, 'add_tag'])->name('add.tag');
    Route::post('/store/tag',[TagController::class, 'store_tag'])->name('store.tag');
    Route::get('/tag/delete/{id}',[TagController::class, 'tag_delete'])->name('tag.delete');


    // Product Added
    Route::get('/add/product',[ProductController::class , 'add_product'])->name('add.product');
    Route::post('/store/product',[ProductController::class , 'store_product'])->name('store.product');
    Route::get('/product/list',[ProductController::class, 'product_list'])->name('product.list');
    Route::get('/edit/product/{id}',[ProductController::class, 'edit_product'])->name('edit.product');
    Route::post('/product/update',[ProductController::class, 'product_update'])->name('product.update');
    Route::get('/product/delete/{id}',[ProductController::class, 'product_delete'])->name('product.delete');
    Route::get('/product/inventory/{id}',[ProductController::class, 'product_inventory'])->name('product.inventory');
    Route::get('product/variant',[ProductController::class, 'product_variant'])->name('product.variant');
    
    // Color & Size
    Route::post('/add/color',[ProductController::class, 'add_color'])->name('add.color');
    Route::get('color/delete{id}',[ProductController::class, 'color_delete'])->name('color.delete');
    Route::post('/add/size',[ProductController::class, 'add_size'])->name('add.size');
    Route::post('/delete/size',[ProductController::class, 'size_delete'])->name('size.delete');

});






// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });  

require __DIR__.'/auth.php';
