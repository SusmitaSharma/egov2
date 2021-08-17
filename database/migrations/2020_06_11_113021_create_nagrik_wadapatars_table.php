<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNagrikWadapatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nagrik_wadapatars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('required_documents')->nullable();
            $table->text('required_procedures')->nullable();
            $table->string('responsible_person');
            $table->string('estimated_time')->nullable();
            $table->string('amount')->nullable();
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('nagrik_wadapatars');
    }
}
