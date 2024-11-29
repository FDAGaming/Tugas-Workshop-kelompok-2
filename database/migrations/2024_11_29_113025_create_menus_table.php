<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama menu
            $table->string('slug')->unique(); // URL untuk menu
            $table->string('url')->nullable(); // Link tujuan menu
            $table->unsignedBigInteger('parent_id')->nullable(); // Untuk menu induk
            $table->boolean('is_active')->default(true); // Status aktif tidaknya menu
            $table->timestamps();
    
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
