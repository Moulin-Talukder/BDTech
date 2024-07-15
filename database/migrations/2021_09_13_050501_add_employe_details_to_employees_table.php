<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeDetailsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('company_name')->nullable();
            $table->string('division_branch')->nullable();
            // $table->integer('department_id')->nullable();
            $table->integer('employee_code')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('national_id')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('nationality')->nullable();

            $table->string('present_address')->nullable();
            $table->string('present_city')->nullable();
            $table->string('present_district')->nullable();

            $table->string('permanent_address')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_district')->nullable();

            $table->integer('office_phone_number')->nullable();
            $table->string('relationship')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('position')->nullable();
            $table->string('grade')->nullable();
            $table->string('qualification')->nullable();
            $table->string('type_of_employee')->nullable();
            $table->string('overtime_count')->nullable();
            $table->date('effective_date')->nullable();
            $table->string('shift')->nullable();
            $table->string('present_salary')->nullable();
            $table->string('attendance_required')->nullable();
            $table->time('work_starting_time')->nullable();
            $table->time('work_ending_time')->nullable();
            $table->time('late_count')->nullable();
            $table->time('early_count')->nullable();
            $table->string('logout_required')->nullable();
            $table->string('half_day_absent')->nullable();
            $table->string('weekly_holiday')->nullable();
            $table->string('total_leave')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            Schema::dropIfExists('employees');
        });
    }
}
