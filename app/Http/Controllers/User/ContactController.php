<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'member_id'=>'required',
            'message'=>'required|string|min:10',
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
        ],[
            'member_id.required'=>'Please Choose shop!',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()], 200);
        }

        $contact =Contact::create([
            'member_id'=>$request->member_id,
            'message'=>$request->message,
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
        ]);
        return response()->json(['success'=>$request->shop . 'will be contact you back soon.'], 200);
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
