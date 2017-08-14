<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_genre', function (Blueprint $table) {
            $table->integer('artist_id')->unsigned();
            $table->integer('genre_id')->unsigned();
            $table->string('image_path')->unique()->nullable();
            $table->timestamps();

            $table->primary(['artist_id', 'genre_id']);

            $table->foreign('artist_id')
                  ->references('id')
                  ->on('artists')
                  ->onDelete('cascade');

            $table->foreign('genre_id')
                  ->references('id')
                  ->on('genres')
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
        Schema::table('artist_genre', function (Blueprint $table) {
            $table->dropForeign('artist_genre_artist_id_foreign');
            $table->dropForeign('artist_genre_genre_id_foreign');
        });

        Schema::dropIfExists('artist_genre');
    }
}
