<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('begin_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('label_id')->unsigned();
            $table->string('country_code');
            $table->timestamps();

            $table->foreign('country_code')
                  ->references('code')
                  ->on('countries')
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
        Schema::table('artists', function (Blueprint $table) {
            $table->dropForeign('artists_country_code_foreign');
            $table->dropForeign('artists_label_id_foreign');
        });

        Schema::dropIfExists('artists');
    }
}
