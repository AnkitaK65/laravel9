<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $mentors = User::where('user_type', 'mentor')->latest()->get();
        if ($request->ajax()) {
            $data = Course::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCourse">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCourse">Delete</a>';
                    $btn = $btn . ' <a href="' . route('courses.show', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="btn btn-info btn-sm viewCourse">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.courseList', ['mentors' => $mentors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //     'mobile' => ['nullable', 'numeric', 'digits:10'],
        // ]);
        // if ($request->hasFile('image')) {
        //     $request->validate([
        //         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        //     ]);
        //     $file = $request->file('image');
        //     $filename = date('YmdHi') . $file->getClientOriginalName();
        //     $file->move(public_path('images/users'), $filename);
        // } else {
        //     $filename = 'user.png';
        // }
        // $user = User::Create(
        //     [
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //         'user_type'  => $request->user_type,
        //         'mobile'  => $request->mobile,
        //         'address'  => $request->address,
        //         'gender'  => $request->gender,
        //         'image'  => $filename
        //     ]
        // );
        // if ($user) {
        //     event(new Registered($user));
        //     return response()->json(['status' => 'success', 'message' =>  'User Details saved successfully.']);
        // }
        return response()->json(['status' => 'failed', 'message' => 'Failed! Course Details not saved.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
