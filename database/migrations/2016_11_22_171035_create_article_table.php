<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name');
	        $table->string('title');
	        $table->text('description');
	        $table->integer('created_by')->unsigned()->index();
	        $table->foreign('created_by')->references('id')->on('users');
	        $table->integer('modified_by')->unsigned()->index();
	        $table->foreign('modified_by')->references('id')->on('users');
	        $table->boolean('on_all');
	        $table->text('html_content');
	        $table->integer('page_id')->unsigned()->index()->nullable();
	        $table->foreign('page_id')->references('id')->on('pages');
	        $table->integer('content_area_id')->unsigned()->index()->nullable();
	        $table->foreign('content_area_id')->references('id')->on('content_areas');
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
        Schema::drop('articles');
    }
}
