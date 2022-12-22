<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

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
        return response()->json(['success' => 'Thank you for contacting us. We will contact you shortly.']);
    }

    public function show_all(Request $request)
    {
        if (Auth::user()->user_type == 'admin') {
            if ($request->ajax()) {
                $data = Contact::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="view btn btn-primary btn-sm viewContact">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('backend.contactList');
        } elseif(Auth::user()->user_type == 'user') {
            $enquiries = Contact::where('email', Auth::user()->email)->latest()->get();
            return view('backend.enquiries', ['enquiries' => $enquiries]);
        } else {
            return view('message.pages-error-403');
        }
    }
}
