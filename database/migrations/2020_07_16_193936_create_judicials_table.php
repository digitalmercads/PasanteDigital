<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudicialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judicials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('actor');
            $table->string('court');
            $table->unsignedBigInteger('type_id');
            $table->bigInteger('status');
            $table->timestamps();

            $table->foreign('type_id')
            ->references('id')
            ->on('judicial_types')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('judicials');
    }
}
