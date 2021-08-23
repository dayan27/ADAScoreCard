<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_plans', function (Blueprint $table) {
            $table->id();
            $table->string('activity');
            $table->integer('quantity_weight');
            $table->integer('time_weight');
            $table->integer('quality_weight');
            $table->date('year');
            $table->date('to');
            $table->date('from');
            $table->double('budget');
            $table->double('goal');
            $table->foreignId('yearly_plan_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('department_plans');
    }
}
