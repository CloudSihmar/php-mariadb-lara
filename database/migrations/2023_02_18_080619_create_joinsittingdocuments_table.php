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
        Schema::create('joinsittingdocuments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('directory_id');
            $table->bigInteger('parliament_id');
            $table->bigInteger('session_id');
            $table->string('name');
            $table->text('keyword');
            $table->string('document');
            $table->string('extension');
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
        Schema::dropIfExists('joinsittingdocuments');
    }
};
