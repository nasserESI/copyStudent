<?php

namespace App\Http\Controllers;
use App\models\course;
use Illuminate\Http\Request;


class courseController extends Controller
{
    public function addCourse(Request $request){

        $course = Course::create([
            'course'=>$request->name,
            'teacher'=>$request->teacher,
        ]);
        $course->save();
        return redirect()->back();
    }

    public function removeCourse($id){
        $course = Course::find($id);

        if($course != null){
            $course->delete();
        }
        return redirect()->back();
    }
}
