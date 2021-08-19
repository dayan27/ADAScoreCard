<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermEfficienciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_efficiencies', function (Blueprint $table) {
            $table->id();
            $table->double('total_behavior_result');
            $table->double('total_term_activity_result');
            $table->double('result');
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();



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
        Schema::dropIfExists('term_efficiencies');
    }
}
