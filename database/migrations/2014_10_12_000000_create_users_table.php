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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->bigInteger('agency_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('division_id')->nullable();
            $table->bigInteger('dzongkhag_id')->nullable();
            $table->bigInteger('constituency_id')->nullable();
            $table->string('users_ids')->nullable();
            $table->string('users_ids_array')->nullable();
            $table->string('serializeHeadId')->nullable();
            $table->bigInteger('headId')->nullable();
            $table->bigInteger('status')->nullable();
            $table->string('contactno')->nullable();
            $table->string('empid')->nullable();
            $table->string('cid')->nullable();
            $table->bigInteger('positiontitle')->nullable();
            $table->bigInteger('positionlevel')->nullable();
            $table->bigInteger('gender')->nullable();
            $table->bigInteger('display_order')->nullable()->default(10);
            $table->bigInteger('userstatus_id')->nullable()->default(1);
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
        Schema::dropIfExists('users');
    }
};
