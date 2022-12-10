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
        $request->validate([
            //'course_id' => ['sometimes', 'numeric'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'mentor' => ['required', 'numeric'],
        ]);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $image = $request->file('image');
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('images/users/' . $request->mentor), $filename);
        }

        if ($request->hasFile('path')) {
            $request->validate([
                'path' => 'required|mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime',
            ]);
            $path = $request->file('path');
            $filename = date('YmdHi') . $path->getClientOriginalName();
            $path->move(public_path('images/users/' . $request->mentor), $filename);
        }

        if ($request->hasFile('attachment')) {
            $request->validate([
                'attachment' => 'required|mimes:pdf|max:100000',
            ]);
            $attachment = $request->file('attachment');
            $filename = date('YmdHi') . $attachment->getClientOriginalName();
            $attachment->move(public_path('images/users/' . $request->mentor), $filename);
        }

        $course = Course::updateOrCreate(
            [
                'id' => $request->course_id
            ],
            [
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'price'  => $request->price,
                'mentor'  => $request->mentor,
                'image'  => $image,
                'path'  => $path,
                'attachment'  => $attachment
            ]
        );
        if ($course) {
            return response()->json(['status' => 'success', 'message' =>  'Course Details saved successfully.']);
        }
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
        $course = Course::find($id);
        return response()->json($course);
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
        Course::find($id)->delete();
        return response()->json(['status' => 'success', 'message' =>  'Course deleted successfully.']);
    }
}
