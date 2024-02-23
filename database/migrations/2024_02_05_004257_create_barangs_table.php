<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function up():void
    {
        Schema::create('barangs', function(Blueprint $table) {
            $table->id();
            $table->text('nama_barang');
            $table->string('gambar');
            $table->timestamps(); 
        });
    }
    

       /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void  
    {
        $shcema::dropifExists('barangs');
    }
  };

