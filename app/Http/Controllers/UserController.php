<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
  // Edit Profile Page 
    function edit_profile(){
        return view('backend.user.edit_profile');
    }
    
    // Profile Info Updated Code
    function update_profile(Request $request){
        if($request->photo){
            if($request->photo){
              $request->validate([
                'photo' => 'mimes:jpg,jpeag,png,webe',
                'photo' => 'file|max:1024',
              ]);
            }
            if(Auth::User()->photo != null){
              $delete_photo = public_path('uploads/users/'.Auth::User()->photo);
              unlink($delete_photo);
            }

            $extension = $request->photo->extension();
            $file_name = uniqid().'.'.$extension;

            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->photo);
            $image->save(public_path('uploads/users/'.$file_name));
            // pic and name update
             User::find(Auth::id())->update([
            'name' => $request->name,
            'photo' => $file_name,
           ]);
           return back()->with('success', 'Profile Updated Successfully');
        }
        else{
           User::find(Auth::id())->update([
            'name' => $request->name,
           ]); 
          return back()->with('success', 'Name Updated Successfully');
        }
    }


    // User Password Update

    function update_password(Request $request){
        $request->validate([
        'current_password' => 'required',
        'password' => [
          'required',
          'confirmed',
          Password::min(8)
          ->letters()
          ->mixedCase()
          ->numbers()
          ->symbols()
        ],
        'password_confirmation' => 'required',
      ]);
      if(Hash::check($request->current_password, Auth::User()->password)){
        User::find(Auth::id())->update([
          'password' => bcrypt($request->password)
        ]);
        return back()->with('success','Password Updated Successfully');
      }
      else {
        return back()->with('wrong', 'Current Password dose not Match');
      }
    }

}
