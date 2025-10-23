<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aduan', function (Blueprint $table) {

        $table->string('kode_aduan')->unique();
        $table->string('nik', 20);
        $table->string('nama', 100);
        $table->string('telfon', 20);
        $table->text('aduan');
        $table->string('file')->nullable(); // bisa null jika tidak ada file
        $table->timestamps(); // untuk created_at dan updated_at
        
        });



    


       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aduan');
   

    }
};
