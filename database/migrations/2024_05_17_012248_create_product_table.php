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
        Schema::create('product', function (Blueprint $table) {
            $table->id();                                 
            $table->unsignedBigInteger('id_user');       
            $table->string('name');                      
            $table->string('price');           
            $table->unsignedBigInteger('id_category');    
            $table->unsignedBigInteger('id_brand');      
            $table->tinyInteger('status')->default(0);   
            $table->decimal('sale', 10, 2)->default(0);  
            $table->string('company');      
            $table->string('avatar')->nullable();       
            $table->text('detail');          
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
