<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistRecordingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_recording', function (Blueprint $table) {
            $table->integer('artist_id')->unsigned();
            $table->integer('recording_id')->unsigned();
            $table->timestamps();

            $table->primary(['artist_id', 'recording_id']);

            $table->foreign('artist_id')
                  ->references('id')
                  ->on('artists')
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
        Schema::table('artist_recording', function (Blueprint $table) {
            $table->dropForeign('artist_recording_artist_id_foreign');
            $table->dropForeign('artist_recording_recording_id_foreign');
        });

        Schema::dropIfExists('artist_recording');
    }
}
