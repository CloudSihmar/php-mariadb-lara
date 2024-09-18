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
        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agency_id')->nullable();
            $table->bigInteger('department_id');
            $table->bigInteger('division_id');
            $table->timestamp('timeIn');
            $table->bigInteger('leave_category_id');
            $table->bigInteger('user_id');
            $table->date('dated');
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
        Schema::dropIfExists('attendance_logs');
    }
};
