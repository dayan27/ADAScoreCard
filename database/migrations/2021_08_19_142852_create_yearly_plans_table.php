<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYearlyPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yearly_plans', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->string('budget');
            $table->boolean('make_visible')->default(0);
           // $table->string('phase');
            $table->date('to');
            $table->date('from');
            $table->foreignId('strategic_plan_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('year_card_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('yearly_plans');
    }
}
