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
        Schema::create('easy_pays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customerId')->constraint('customers');
            $table->string("splynx_id");
            $table->string("easypay_number");
            $table->string("reciever_id");
            $table->string("charachter_length");
            $table->string("check_digit");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('easy_pays');
    }
};
