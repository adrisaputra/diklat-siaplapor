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
        Schema::create('harmonizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->string('upload_fix')->nullable();
            $table->date('upload_date')->nullable();
            $table->string('taker_name')->nullable();
            $table->date('taker_date')->nullable();
            $table->enum('type', ['kirim_ke_opd','kirim_ke_admin','selesai']);
            $table->string('depositor_name')->nullable();
            $table->string('initials1')->nullable();
            $table->string('initials2')->nullable();
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
        Schema::dropIfExists('harmonizations');
    }
};
