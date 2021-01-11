<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileUploadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_uploades', function (Blueprint $table) {
            $table->id();
            // $table->binary('picture');
            // $table->binary('file');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE file_uploades ADD picture  MEDIUMBLOB, ADD file  MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_uploades');
    }
}
