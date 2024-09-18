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
        Schema::create('receiveletters', function (Blueprint $table) {
            $table->id();
            $table->string('doc_id');
            $table->string('from_agency')->nullable();
            $table->string('from_department')->nullable();
            $table->string('from_division')->nullable();
            $table->string('dak_number')->nullable();
            $table->date('receive_date')->nullable();
            $table->string('to_adressed')->nullable();
            $table->bigInteger('to_agency_id')->nullable();
            $table->bigInteger('to_department_id')->nullable();
            $table->bigInteger('to_division_id')->nullable();
            $table->string('to_subject')->nullable();
            $table->string('file_index')->nullable();
            $table->string('author');
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
        Schema::dropIfExists('receiveletters');
    }
};
