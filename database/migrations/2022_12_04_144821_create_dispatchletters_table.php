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
        Schema::create('dispatchletters', function (Blueprint $table) {
            $table->id();
            $table->string('doc_id');
            $table->bigInteger('from_agency_id')->nullable();
            $table->bigInteger('from_department_id')->nullable();
            $table->bigInteger('from_division_id')->nullable();
            $table->string('dispatch_number');
            $table->date('issue_date')->nullable();
            $table->string('to_adressed')->nullable();
            $table->string('to_agency')->nullable();
            $table->string('to_department')->nullable();
            $table->string('to_division')->nullable();
            $table->string('to_place')->nullable();
            $table->string('to_subject')->nullable();
            $table->string('file_index')->nullable();
            $table->string('author')->nullable();
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
        Schema::dropIfExists('dispatchletters');
    }
};
