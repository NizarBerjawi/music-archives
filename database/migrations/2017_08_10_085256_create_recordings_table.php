<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recordings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('playlength');
            $table->date('release_date');
            $table->integer('label_id')->unsigned();
            $table->string('image_path')->unique();
            $table->timestamps();

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
        Schema::table('recordings', function (Blueprint $table) {
            $table->dropForeign('recordings_label_id_foreign');
        });

        Schema::dropIfExists('recordings');
    }
}
