<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrategicPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strategic_plans', function (Blueprint $table) {
            $table->id();
            $table->string('action');
<<<<<<< HEAD
=======
            // $table->string('perspective');
>>>>>>> 4e7d9bbddfc370025f330f860f4a7390fde022f2
            $table->date('to');
            $table->date('from');
            $table->string('phase');
            $table->foreignId('perspective_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('score_card_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('perspective_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('strategic_plans');
    }
}
