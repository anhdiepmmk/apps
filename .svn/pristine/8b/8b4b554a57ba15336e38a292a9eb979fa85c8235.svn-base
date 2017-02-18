<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cat_id');
            $table->unsignedInteger('developer_id');
            $table->string('name');
            $table->string('slug');
            $table->longText('content');
            $table->string('path');
            $table->string('image');
            $table->text('thumbs');
            $table->string('os');
            $table->string('numDownloads');
            $table->integer('views');
            $table->string('link');
            $table->string('keyword');
            $table->string('description');
            $table->decimal('rate_value',2,1);
            $table->unsignedInteger('rate_count');
            $table->timestamp('publish_at');
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
        Schema::drop('apps');
    }
}
