<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceArsipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_arsips', function (Blueprint $table) {
            $table->id();
            $table->enum('kode', ['tax', 'non_tax']);
            $table->string('no_invoice');
            $table->foreignId('pelanggan_id')->constrained()->cascadeOnDelete();
            $table->string('alamat');
            $table->date('tanggal');
            $table->string('judul');
            $table->unsignedBigInteger('down_payment')->nullable();
            $table->unsignedBigInteger('kekurangan_bayar')->nullable();
            $table->unsignedBigInteger('total_invoice')->nullable();
            $table->enum('status', ['LUNAS', 'BELUM LUNAS']);
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
        Schema::dropIfExists('invoice_arsips');
    }
}
