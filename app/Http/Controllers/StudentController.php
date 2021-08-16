<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all()->toArray();
        return array_reverse($students);
    }

    public function store(Request $request)
    {
        $student = new Student([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'gender' => $request->input('gender')
        ]);
        $student->save();

        return response()->json('Student created successfully!');
    }

    public function show($id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }

    public function update($id, Request $request)
    {
        $student = Student::find($id);
        $student->update($request->all());

        return response()->json('Student data updated successfully!');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        return response()->json('Student deleted successfully!');
    }
}
