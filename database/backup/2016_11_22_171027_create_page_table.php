<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name');
	        $table->string('alias');
	        $table->text('description');
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
        Schema::drop('pages');
    }
}
