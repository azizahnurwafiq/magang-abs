<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pre_order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->string('jenis_pekerjaan');
            $table->string('deadline');
            $table->string('bahan');
            $table->string('warna');
            $table->string('model');
            $table->string('item');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('total');
            $table->string('kebutuhan_bahan')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('pre_order_details');
    }
}
