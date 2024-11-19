<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stok_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('jumlah')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->unsignedBigInteger('total_stok');
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
        Schema::dropIfExists('stok_histories');
    }
}
