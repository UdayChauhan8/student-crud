<?php

use App\Http\Controllers\StudentController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

/*
|--------------------------------------------------------------------------
| Landing Page Helper Routes
|--------------------------------------------------------------------------
| The landing page has an "Update" card, but edit pages require a specific
| student id (/students/{student}/edit). This helper redirects to:
| - latest student's edit page (if a student exists)
| - create form (if no students exist yet)
*/
Route::get('/students/quick-edit', function () {
    $student = Student::orderByDesc('created_at')->first();

    if (! $student) {
        return redirect()->route('students.create');
    }

    return redirect()->route('students.edit', $student);
})->name('students.quickEdit');

/*
|--------------------------------------------------------------------------
| Student CRUD Routes (Resourceful Routing)
|--------------------------------------------------------------------------
| Browser -> Route -> Controller -> Model -> Database -> View -> Response
|
| Route::resource('students', StudentController::class) automatically creates:
| GET      /students              -> StudentController@index   (list students)
| GET      /students/create       -> StudentController@create  (show create form)
| POST     /students              -> StudentController@store   (save new student)
| GET      /students/{student}/edit -> StudentController@edit  (show edit form)
| PUT      /students/{student}    -> StudentController@update  (update student)
| DELETE   /students/{student}    -> StudentController@destroy (delete student)
|
| Note: Laravel also generates a "show" route by default, but we intentionally do NOT use it
| in this project to keep the controller interview-ready and minimal.
*/
Route::resource('students', StudentController::class)->except(['show']);
