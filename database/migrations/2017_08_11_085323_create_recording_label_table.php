<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordingLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recording_label', function (Blueprint $table) {
            $table->integer('recording_id')->unsigned();
            $table->integer('label_id')->unsigned();
            $table->timestamps();

            $table->primary(['recording_id', 'label_id']);

            $table->foreign('recording_id')
                  ->references('id')
                  ->on('recordings')
                  ->onDelete('cascade');

            $table->foreign('label_id')
                  ->references('id')
                  ->on('labels')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recording_label');
    }
}
