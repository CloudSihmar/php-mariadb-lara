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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('author');
            $table->string('document')->nullable();
            $table->date('fromDate');
            $table->date('toDate');
            $table->bigInteger('status')->default(0);
            $table->bigInteger('leave_category_id');
            $table->string('employeeRemarks')->nullable();
            $table->string('headRemarks')->nullable();
            $table->bigInteger('agency_id')->nullable();
            $table->bigInteger('department_id');
            $table->bigInteger('division_id');
            $table->bigInteger('actionby')->nullable();
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
        Schema::dropIfExists('leaves');
    }
};
