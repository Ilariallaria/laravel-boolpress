<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // aggiungo colonna
            $table->unsignedBiginteger('category_id')->nullable();
            // aggiungo relazione alla colonna
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //down della relazione
            $table->dropForeign('posts_category_id_foreign');
            // down della colonna
            $table->dropColumn('category_id');
        });
    }
}
