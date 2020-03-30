<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('pic');
            $table->dateTime('datetime_issue');
            $table->unsignedBigInteger('defect_type');
            $table->string('defect_desc');
            $table->unsignedBigInteger('responsibility_by');
            $table->smallInteger('priority')->comment('1- Low, 2- Medium, 3- High, 4- Urgent');
            $table->string('image');
            $table->string('remark');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();

            $table->foreign('defect_type')
                ->references('id')->on('defect_types')
                ->onDelete('restrict');

            $table->foreign('responsibility_by')
                ->references('id')->on('responsibilities')
                ->onDelete('restrict');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cases');
    }
}
