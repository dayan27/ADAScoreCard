<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_cards', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->date('from');
            $table->date('to');
            $table->integer('number_of_term');
            $table->boolean('make_visible')->default(0);
            $table->boolean('is_completed')->default(0);
            $table->foreignId('department_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('score_card_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('department_cards');
    }
}
