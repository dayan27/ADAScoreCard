<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBehaviorsUserResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('behavior_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('behavior_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('term_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('department_card')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('result_scale');
            $table->integer('result');
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
        Schema::dropIfExists('behaviors_user_results');
    }
}
