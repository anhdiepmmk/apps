<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appfiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('version_id');
            $table->string('server');
            $table->string('filepath');
            $table->string('filename');
            $table->decimal('filesize');
            $table->unsignedInteger('downloads');
            $table->timestamp('lasted_download');
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
        Schema::drop('appfiles');
    }
}
