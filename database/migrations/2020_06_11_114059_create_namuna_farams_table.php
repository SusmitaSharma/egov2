<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNamunaFaramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('namuna_farams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('economical_year');
            $table->string('last_changable_date')->nullable();
            $table->string('changable_person')->nullable();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('namuna_farams');
    }
}
