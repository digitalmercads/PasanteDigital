<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudicialRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judicial_relations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('judicial_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->timestamps();

            $table->foreign('judicial_id')
                ->references('id')
                ->on('judicials')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('agent_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('judicial_relations');
    }
}
