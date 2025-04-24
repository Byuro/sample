<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display a listing of students with multiple filtered queries (for views)
    public function index()
    {
        // Fetch all students from the database
        $allStudents = Student::all();

        // Filtered queries
        $studentsByStudID = Student::where('StudID', '=', '123')->get();
        $studentsAbove18 = Student::where('age', '>', 18)->get();
        $studentsCourseOrYear = Student::where('course', 'Engineering')
                                        ->orWhere('year', '3')
                                        ->get();
        $filteredStudents = Student::where('age', '>', 18)
                                    ->where('course', '=', 'Engineering')
                                    ->where('StudID', '!=', '123')
                                    ->get();

        // Return all students and filtered queries as JSON
        return response()->json([
            'all_students' => $allStudents,
            'students_by_studID' => $studentsByStudID,
            'students_above_18' => $studentsAbove18,
            'students_course_or_year' => $studentsCourseOrYear,
            'filtered_students' => $filteredStudents
        ]);
    }

    // API: return all students as JSON
    public function apiIndex()
    {
        $students = Student::all();

        return response()->json([
            'students' => $students,
        ]);
    }

    // Web: show student creation form
    public function create()
    {
        return view('students.create');
    }

    // ✅ API: Store and return created student + all students
    public function store(Request $request)
    {
        // Log the incoming request data to debug
        \Log::info('Student created:', $request->all());

        // Validate the request data
        $request->validate([
            'StudID' => 'required|unique:students',
            'lastname' => 'required',
            'firstname' => 'required',
            'sex' => 'required',
            'age' => 'required|integer',
            'address' => 'required',
            'contact_no' => 'required',
            'course' => 'required',
            'year' => 'required',
        ]);

        // Create the new student
        $student = Student::create($request->all());

        // Get all students after creation
        $allStudents = Student::all(['StudID', 'lastname', 'firstname', 'sex', 'age', 'address', 'contact_no', 'course', 'year']);

        // Return response with added student and all students
        return response()->json([
            'message' => 'Student added successfully!',
            'student' => $student->only(['StudID', 'lastname', 'firstname', 'sex', 'age', 'address', 'contact_no', 'course', 'year']),
            'students' => $allStudents
        ]);
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'StudID' => 'required',
            'lastname' => 'required',
            'firstname' => 'required',
            'sex' => 'required',
            'age' => 'required|integer',
            'address' => 'required',
            'contact_no' => 'required',
            'course' => 'required',
            'year' => 'required',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index');
    }
}
