<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Students;
use App\Http\Requests\v1\StoreStudentsRequest;
use App\Http\Requests\v1\UpdateStudentsRequest;

use App\Http\Controllers\Controller;

class StudentsController extends Controller
{

    public function index()
    {
        return Students::paginate(10);
    }
    public function store(StoreStudentsRequest $request)
    {
        Students::create($request->all());

        return [
            'message'=>'Student Enrolled successfully'
        ];
    }
    public function show(Students $students,$id)
    {
        return Students::find($id);
    }
    public function update(UpdateStudentsRequest $request, Students $students, $id)
    {
        $student = Students::find($id);

        if($student){
            $student->update($request->all());

            return response()->json(['message' => 'Student updated successfully!'], 200);
        }else{
            return response()->json(['message' => 'Student not found.'], 404);
        }
    }
    public function destroy(Students $students,$id)
    {
        $student = Students::find($id);

        if($student){
            $student->delete();

            return response()->json(['message' => 'Student successfully deleted!'], 200);
        }else{
            return response()->json(['message' => 'Student not found.'], 404);
        }
    }
}