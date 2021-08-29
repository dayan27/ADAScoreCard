<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('term_no');
            $table->date('to');
            $table->date('from');
            $table->boolean('make_visible')->default(0);
            $table->text('comment')->nullable();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('department_card_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('terms');
    }
}
