<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_supplier')->unsigned();
            $table->foreign('id_supplier')->references('id')->on('suppliers');
            $table->bigInteger('id_barang')->unsigned();
            $table->foreign('id_barang')->references('id')->on('barangs');
            $table->integer('jumlah_pengiriman');
            $table->date('tgl_pengiriman');
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
        Schema::dropIfExists('barang_keluars');
    }
}