<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMemberTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_tasks', function (Blueprint $table) {
            $table->string("title")->nullable()->after('id');
            $table->integer("brick_id")->after('title');
            $table->date("due_date")->after('title');
            $table->longText("note")->after('description');
            $table->float("working_hours",8,2)->after('note');
            $table->tinyInteger("status")->after('working_hours')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_tasks', function (Blueprint $table) {
            //
        });
    }
}
