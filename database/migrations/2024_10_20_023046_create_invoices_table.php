<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->enum('kode', ['tax', 'non_tax']);
            $table->string('no_invoice')->unique();
            $table->foreignId('pelanggan_id')->constrained()->cascadeOnDelete();
            $table->string('alamat');
            $table->date('tanggal');
            $table->string('judul');
            $table->unsignedBigInteger('down_payment')->nullable();
            $table->unsignedBigInteger('kekurangan_bayar')->nullable();
            $table->unsignedBigInteger('total_invoice')->nullable();
            $table->enum('status', ['LUNAS', 'BELUM LUNAS']);
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
        Schema::dropIfExists('invoices');
    }
}
