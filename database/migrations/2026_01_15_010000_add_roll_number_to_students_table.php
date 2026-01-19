<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedInteger('roll_number')->nullable()->unique()->after('id');
        });

        // Backfill roll numbers for existing records (ascending by id)
        $students = DB::table('students')->orderBy('id')->select('id')->get();
        $roll = 1;
        foreach ($students as $student) {
            DB::table('students')->where('id', $student->id)->update(['roll_number' => $roll]);
            $roll++;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropUnique(['roll_number']);
            $table->dropColumn('roll_number');
        });
    }
};
