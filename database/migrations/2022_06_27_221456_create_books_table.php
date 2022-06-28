<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('author');
            $table->unsignedBigInteger('loan_status_id');
            $table->unsignedBigInteger('genre_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('genre_id', 'fk_genre_id')
                ->references('id')->on('genres');

            $table->foreign('loan_status_id', 'fk_loan_status_id')
                ->references('id')->on('loan_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
