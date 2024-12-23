<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreOrderArsipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_order_arsips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pre_order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pekerjaan_id')->constrained()->cascadeOnDelete();
            $table->date('deadline')->nullable();
            $table->string('item')->nullable();
            $table->string('quantity')->nullable();
            $table->string('kebutuhan_bahan')->nullable();
            $table->text('note')->nullable();
            $table->text('note_produksi')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('pre_order_arsips');
    }
}
