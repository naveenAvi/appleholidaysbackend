<?php

namespace App\Http\Controllers;

use App\Models\StudentsModel;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function CreateStudents(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|max:30',
            'secondName' => 'required|max:30',
            'email' => 'required|max:30',
            'address' => 'required|max:100'
        ]);
        if($request->id){
            $StudentsModel = StudentsModel::where(["id"=>$request->id])->first();
        }else{
            $StudentsModel = new StudentsModel();
        }

        $StudentsModel->firstName = $request->firstName;
        $StudentsModel->secondName = $request->secondName;
        $StudentsModel->email = $request->email;
        $StudentsModel->address = $request->address;
        $StudentsModel->save();

        if($request->id){
            return response()->json(['message' => "updated", "addeduser" => $StudentsModel]);
        }else{
            return response()->json(['message' => "added", "addeduser" => $StudentsModel]);

        }
    }

    public function listStudents(Request $request)
    {
        $StudentsModel = StudentsModel::get();


        return response()->json(['message' => "get", "userlist" => $StudentsModel]);
    }

    public function getSingleStudent(Request $request)
    {
        $StudentsModel = StudentsModel::where(["id" => $request->userid])->first();
        if ($StudentsModel) {
            return response()->json(['message' => "get", "student" => $StudentsModel]);
        }
        return response()->json(['message' => "student-not-found"]);
    }

    public function deleteStudent(Request $request)
    {
        $StudentsModel = StudentsModel::where(["id" => $request->userid])->delete();
        
        return response()->json(['message' => "student-delteed"]);
    }

    
}
