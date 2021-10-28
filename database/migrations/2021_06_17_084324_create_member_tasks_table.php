<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('assigned_to');
            $table->integer('assigned_by');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_tasks');
    }
}
