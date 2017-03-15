<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCssTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name');
	        $table->text('description');
	        $table->boolean('active')->nullable();
	        $table->text('css_content');
	        $table->integer('created_by')->unsigned()->index();
	        $table->integer('modified_by')->unsigned()->index();
            $table->timestamps();

	        $table->foreign('created_by')->references('id')->on('users');
	        $table->foreign('modified_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('templates');
    }
}
