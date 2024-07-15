<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('employee_id')->index();
            $table->integer('user_id')->index();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('num_of_days')->nullable();
            $table->string('type')->nullable();
            $table->string('reason')->nullable();
            $table->integer('status')->dafault(1)->comment('1 is for Pending, 2 is for Approved, 3 is for Cancelled');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('leaves');
    }
}
