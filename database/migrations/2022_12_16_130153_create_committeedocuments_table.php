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
        Schema::create('committeedocuments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('committee_id');
            $table->bigInteger('documenttype_id');
            $table->bigInteger('parliament_id');
            $table->string('name');
            $table->text('keyword');
            $table->string('document');
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
        Schema::dropIfExists('committeedocuments');
    }
};
