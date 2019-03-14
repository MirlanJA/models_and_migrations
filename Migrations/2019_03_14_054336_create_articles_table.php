<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
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
            $table->string('title', 150);
            $table->text('body')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('heading_id');
            $table->timestamps();

            //индексы
            $table->index('title');

            //связь с пользователем
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            //связь с рубрикой
            $table->foreign('heading_id')
                ->references('id')
                ->on('headings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
