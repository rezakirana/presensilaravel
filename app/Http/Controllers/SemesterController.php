<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Semester;

class SemesterController extends Controller
{
    public function index()
    {
        $this->data['semester'] = Semester::all();

        return view('semester.index', $this->data);
    }

    public function change($id)
    {
        $semester = Semester::findOrFail($id);
        if ($semester->status == 1) {
            $semester->status = 0;            
            $semester->save();
            $otherSemester = Semester::where('id','!=',$id)->update(['status' => 1]);
        }else {
            $semester->status = 1;
            $semester->save();
            $otherSemester = Semester::where('id','!=',$id)->update(['status' => 0]);
        }

        return redirect()->route('semester.index')->with('success', 'Semester berhasil diubah!');
    }
}
