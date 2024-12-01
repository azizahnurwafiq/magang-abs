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
            $table->foreignId('pekerjaan_id')->constrained()->cascadeOnDelete();
            $table->date('deadline')->nullable();
            $table->string('item')->nullable();
            $table->unsignedBigInteger('quantity')->nullable();
            $table->string('kebutuhan_bahan')->nullable();
            $table->text('note')->nullable();
            $table->text('note_produksi')->nullable();
            $table->enum('status', ['DIAMBIL', 'WIP', 'BUTUH DIKERJAKAN', 'HOLD', 'DONE AND READY', 'REVISI', 'BATAL'])->nullable();
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