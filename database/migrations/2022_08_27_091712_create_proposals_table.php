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
        Schema::create('proposals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->enum('type', ['Draft SK', 'Pergub', 'Perda', 'MOU', 'NPHD', 'Nota Kesepahaman', 'Lainnya']);
            $table->text('about')->nullable();
            $table->string('cover_letter')->nullable();
            $table->string('review_staff')->nullable();
            $table->string('official_memo')->nullable();
            $table->string('approval_concept')->nullable();
            $table->string('draft')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('proposals');
    }
};
