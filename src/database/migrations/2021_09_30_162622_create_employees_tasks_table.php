<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_tasks', function (Blueprint $table) {
          $table->id();
          $table->foreignId('employee_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
          $table->foreignId('task_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees_tasks');
    }
}
