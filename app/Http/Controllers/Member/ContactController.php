<?php

namespace App\Http\Controllers\Member;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::where('member_id',Auth::user()->id)->get();
        return view('page.contact.index',compact('contacts'));
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact->member_id == Auth::user()->id) {
            $contact->delete();
            return back()->with('success','Contact Deleted.');
        }else{
            abort(403,'Unauthorization');
        }
    }
}
