<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = User::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $url = asset('images/users/' . $row->image);
                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="' . route('users.edit', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>';
                    $btn = $btn . ' <a href="' . route('users.show', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="btn btn-info btn-sm viewUser">View</a>';
                    return $btn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('backend.userList');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->user_type == 'admin') {
            return view('users.add');
        }
        return view('message.pages-error-403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile' => ['nullable', 'numeric', 'digits:10'],
        ]);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/users'), $filename);
        } else {
            $filename = 'user.png';
        }
        $user = User::Create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type'  => $request->user_type,
                'mobile'  => $request->mobile,
                'address'  => $request->address,
                'gender'  => $request->gender,
                'image'  => $filename
            ]
        );
        if ($user) {
            if ($request->ajax()) {
                event(new Registered($user));
                return response()->json(['status' => 'success', 'message' =>  'User Details saved successfully.']);
            } else {
                return redirect()->route('users.create')
                    ->with('success', 'User added successfully');
            }
        } else {
            if ($request->ajax()) {
                return response()->json(['status' => 'failed', 'message' => 'Failed! User Details not saved.']);
            } else {
                return redirect()->route('users.create')
                    ->with('failure', 'User creation failed...');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $user = User::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($user)],
            'mobile' => ['nullable', 'numeric', 'digits:10'],
        ]);

        $user = User::find($id);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/users'), $filename);
            $user->image = $filename;
            // $path = $request->file('image')->store('images/users');
            // $user->image = $path;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->user_type = $request->user_type;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->save();

        if (Auth::user()->user_type == 'admin') {
            return redirect()->route('users.index', $user)
                ->with('success', 'User updated successfully');
        } else {
            return redirect()->route('users.show', $user)
                ->with('success', 'User updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['status' => 'success', 'message' =>  'User deleted successfully.']);
    }

    public function changePassword()
    {
        return view('users.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with("status", "Password changed successfully!");
    }
}
