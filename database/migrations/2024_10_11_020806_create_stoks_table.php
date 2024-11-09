<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            $table->string('SKU');
            $table->foreignId('kategori_id')->constrained()->cascadeOnDelete();
            $table->string('item');
            $table->unsignedBigInteger('jumlah');
            $table->date('tanggal_masuk')->nullable();
            $table->unsignedBigInteger('harga_beli')->nullable();
            $table->unsignedBigInteger('harga_jual')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stoks');
    }
}
