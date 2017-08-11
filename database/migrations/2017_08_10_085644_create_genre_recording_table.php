<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreRecordingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_recording', function (Blueprint $table) {
            $table->integer('genre_id')->unsigned();
            $table->integer('recording_id')->unsigned();
            $table->timestamps();

            $table->primary(['genre_id', 'recording_id']);

            $table->foreign('genre_id')
                  ->references('id')
                  ->on('genres')
                  ->onDelete('cascade');

            $table->foreign('recording_id')
                  ->references('id')
                  ->on('recordings')
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
        Schema::table('genre_recording', function (Blueprint $table) {
            $table->dropForeign('genre_recording_genre_id_foreign');
            $table->dropForeign('genre_recording_recording_id_foreign');
        });

        Schema::dropIfExists('genre_recording');
    }
}
