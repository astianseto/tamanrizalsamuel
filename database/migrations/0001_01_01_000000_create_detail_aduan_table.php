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
      
        Schema::create('detailaduan', function (Blueprint $table) {

            $table->id();
            $table->string('kode_aduan')->constrained('aduan')->onDelete('cascade');
            $table->string('status', 50);
            $table->timestamps();
        });

    


       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('detailaduan');

    }
};
