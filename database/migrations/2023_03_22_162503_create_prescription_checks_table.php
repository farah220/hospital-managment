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
        Schema::create('prescription_checks', function (Blueprint $table) {
            $table->id();
            $table->decimal('price');
            $table->unsignedBigInteger('prescription_id');
            $table->unsignedBigInteger('checks_id');
            $table->foreign('checks_id')->references('id')->on('checks')->cascadeOnDelete();
            $table->foreign('prescription_id')->references('id')->on('checks')->cascadeOnDelete();
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
        Schema::dropIfExists('prescription_checks');
    }
};
