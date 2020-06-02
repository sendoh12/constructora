<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCdImgenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cd_imgenes', function (Blueprint $table) {
            $table->bigIncrements("ID_IMAGEN");
            $table->string('NOMBRE_IMG',100);
            $table->string('IMGAEN',100);
            $table->integer('ORDEN_IMG');
            $table->integer('ID_PROYECTO',11);
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
        Schema::dropIfExists('cd_imgenes');
    }
}
