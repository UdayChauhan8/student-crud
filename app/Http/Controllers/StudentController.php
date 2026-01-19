<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     *
     * Flow: Browser -> Route -> Controller -> Model -> Database -> View -> Response
     */
    public function index()
    {
        $students = Student::orderBy('roll_number')->orderBy('id')->get();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $maxRoll = (int) (Student::max('roll_number') ?? 0);
        $nextRollNumber = $maxRoll + 1;

        return view('students.create', compact('nextRollNumber'));
    }

    /**
     * Store a newly created student in the database.
     *
     * Uses Laravel validation. On validation failure, Laravel automatically
     * redirects back with errors + old input.
     */
    public function store(Request $request)
    {
        $courses = config('courses.list');

        $validated = $request->validate([
            'roll_number' => ['required', 'integer', 'min:1', 'unique:students,roll_number'],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
                'unique:students,email',
            ],
            'course' => ['required', 'string', Rule::in($courses)],
        ]);

        Student::create($validated);

        return redirect()->route('students.index');
    }

    /**
     * Show the form for editing the specified student.
     *
     * Route Model Binding automatically converts {student} to a Student model.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in the database.
     */
    public function update(Request $request, Student $student)
    {
        $courses = config('courses.list');

        $validated = $request->validate([
            'roll_number' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('students', 'roll_number')->ignore($student->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
                Rule::unique('students', 'email')->ignore($student->id),
            ],
            'course' => ['required', 'string', Rule::in($courses)],
        ]);

        $student->update($validated);

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified student from the database.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index');
    }
}
