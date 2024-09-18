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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('checkIn');
            $table->string('inStatus');
            $table->string('outStatus')->nullable();
            $table->integer('checkOut')->nullable();
            $table->integer('status')->default(0);
            $table->string('ip_address');
            $table->string('inNotes')->nullable();
            $table->string('outNotes')->nullable();
            $table->bigInteger('department_id');
            $table->bigInteger('division_id');
            $table->bigInteger('author');
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
        Schema::dropIfExists('attendances');
    }
};
