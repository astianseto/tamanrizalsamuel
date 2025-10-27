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

            $table->string('kode_aduan', 255)->primary(); // ✅ primary key
            $table->string('nik', 20); // ✅ index
            $table->string('nama', 100);
            $table->string('alamat', 255); // ✅ ubah jadi 255
            $table->string('telfon', 20);
            $table->text('aduan');
            $table->string('file', 255)->nullable();
            $table->timestamps(); // ✅ created_at & updated_at
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
