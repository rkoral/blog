<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id'); //ilişkisel
            $table->string('title');
            $table->string('image');
            $table->longText('content');
            $table->integer('hit')->default(0);
            $table->string('slug');
            $table->string('status')->default(0)->comment('Kapalı 0 | Aktif 1');
            $table->timestamps();

            $table->foreign('category_id')
            ->references('id')
            ->on('categories');
            //->onDelete('cascade'); //kategori silinirse o kategoriye ait tüm yazıların da silinmesi için

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
