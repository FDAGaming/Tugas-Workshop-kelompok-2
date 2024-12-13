<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat');
            $table->date('tanggal_terima'); 
            $table->integer('jumlah_stock'); 
            $table->string('foto')->nullable();
            $table->decimal('harga', 15, 2); 
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade'); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('obats');
    }
};
