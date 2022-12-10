<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contactForm');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        Contact::create($request->all());
        
        //Normal Request
        //return redirect()->back()
        //    ->with(['success' => 'Thank you for contacting us. We will contact you shortly.']);

        //Ajax Call
        return response()->json(['success'=>'Thank you for contacting us. We will contact you shortly.']);
    }
}
