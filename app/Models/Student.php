<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Student model represents the "students" table.
 *
 * Controller uses this model (Eloquent ORM) to read/write student records
 * without writing raw SQL.
 */
class Student extends Model
{
    /**
     * Mass-assignable fields.
     *
     * This allows: Student::create($validatedData)
     */
    protected $fillable = [
        'roll_number',
        'name',
        'email',
        'course',
    ];
}
