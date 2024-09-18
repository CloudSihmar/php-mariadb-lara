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
        Schema::create('supervisor_updated_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('old_headId')->nullable();
            $table->bigInteger('new_headId')->nullable();
            $table->text('user_id')->nullable();
            $table->date('fromdate');
            $table->date('todate');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('supervisor_updated_logs');
    }
};
