<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function image_change(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:5120',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 200);
        }
        $user = User::find($request->user()->id);
        $path = 'images/' . $user->profile_photo_path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $image = 'user-' . $user->id . '-profile-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images'), $image);
        $user->update([
            'profile_photo_path' => $image,
        ]);
        return response()->json(['success' => "Profile Image Updated.", 'path' => $user->profile_photo_path], 200);
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$request->user()->id,
            'phone'=>'required|unique:users,phone,'.$request->user()->id,
            'gender'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 200);
        }
        $user = User::find($request->user()->id);
        if ($user->email != $request->email) {
            $user->email = $request->email;
            $user->activate = false;
        }
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->update();
        return response()->json(['success'=>'Profile updated'], 200);
    }

    //Update Password
    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password'=>'required|string|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 200);
        }
        $user = User::find($request->user()->id);
        if (Hash::check($request->password,$user->password)) {
            return response()->json(['error'=>['New Password must not be same as old password!']], 200);

        }
        $user->update([
            'password'=>Hash::make($request->password)
        ]);
        return response()->json(['success'=>'Password updated'], 200);
    }
}
